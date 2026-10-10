<?php

namespace App\Services;

use App\Exceptions\LeadImportException;
use App\Models\Lead;
use App\Models\LeadCategory;
use App\Support\LeadContactData;
use Generator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use Throwable;

class LeadSpreadsheetImporter
{
    public const MAX_ROWS = 5000;

    public const MAX_COLUMNS = 100;

    public const MAX_ERRORS = 1000;

    public const MAX_FILE_KB = 10240;

    private array $errors = [];

    /** Validate the complete file before writing anything. Import never updates existing contacts. */
    public function import(TemporaryUploadedFile $file, string $delimiter = 'auto'): array
    {
        $this->errors = [];
        $extension = strtolower($file->getClientOriginalExtension());
        if (! in_array($extension, ['xlsx', 'csv'], true)) {
            $this->fail(__('leads.unsupported_file'));
        }
        if ($file->getSize() > self::MAX_FILE_KB * 1024) {
            $this->fail(__('leads.file_too_large'));
        }

        $path = $file->getRealPath();
        if (! $path || ! is_readable($path)) {
            $this->fail(__('leads.unreadable_file'));
        }

        $categories = LeadCategory::query()->get()->keyBy(fn (LeadCategory $category) => LeadContactData::trim($category->name));
        $records = [];
        $headers = null;
        $rowCount = 0;

        try {
            $rows = $extension === 'csv' ? $this->csvRows($path, $delimiter) : $this->excelRows($path);
            foreach ($rows as $rowNumber => $cells) {
                if ($rowNumber === 1) {
                    $headers = $this->headers($cells);
                    if ($this->errors !== []) {
                        break;
                    }

                    continue;
                }

                if ($this->blank($cells)) {
                    continue;
                }
                $rowCount++;
                $record = ['name' => '', 'lead_category_id' => null, 'phones' => [], 'emails' => [], 'notes' => null];
                $before = count($this->errors);
                foreach ($cells as $index => $cell) {
                    $value = LeadContactData::trim($cell['value']);
                    $header = $headers[$index] ?? null;
                    $column = Coordinate::stringFromColumnIndex($index + 1);
                    $label = $column.(isset($header['label']) ? ' — '.$header['label'] : '');

                    if ($cell['type'] === DataType::TYPE_FORMULA) {
                        $this->error($rowNumber, $label, $value, __('leads.formula_not_allowed'));

                        continue;
                    }
                    if ($cell['type'] === DataType::TYPE_ERROR) {
                        $this->error($rowNumber, $label, $value, __('leads.excel_error'));

                        continue;
                    }
                    if ($header === null) {
                        if ($value !== '') {
                            $this->error($rowNumber, $column, $value, __('leads.missing_column_header'));
                        }

                        continue;
                    }
                    if ($value === '') {
                        continue;
                    }

                    switch ($header['field']) {
                        case 'name':
                            $record['name'] = $value;
                            if (mb_strlen($value) > 255) {
                                $this->error($rowNumber, $label, $value, __('leads.text_too_long', ['max' => 255]));
                            }
                            break;
                        case 'notes':
                            $record['notes'] = $value;
                            if (mb_strlen($value) > 10000) {
                                $this->error($rowNumber, $label, $value, __('leads.text_too_long', ['max' => 10000]));
                            }
                            break;
                        case 'category':
                            if (! $categories->has($value)) {
                                $this->error($rowNumber, $label, $value, __('leads.unknown_category'));
                            } else {
                                $record['lead_category_id'] = $categories->get($value)->id;
                            }
                            break;
                        case 'phones':
                        case 'emails':
                            $field = $header['field'];
                            if ($field === 'phones' && $cell['type'] === DataType::TYPE_NUMERIC) {
                                $this->error($rowNumber, $label, $value, __('leads.numeric_phone'));
                                break;
                            }
                            $parts = preg_split('/[|;,،؛\r\n]+/u', $value, -1, PREG_SPLIT_NO_EMPTY);
                            $valueCount = count($record[$field]);
                            foreach ($parts as $part) {
                                $part = LeadContactData::trim($part);
                                if ($part === '') {
                                    continue;
                                }
                                if ($field === 'phones') {
                                    if (mb_strlen($part) > 50 || ! LeadContactData::validPhone($part)) {
                                        $this->error($rowNumber, $label, $part, __('leads.invalid_phone'));
                                    }
                                    $record['phones'][] = LeadContactData::phone($part);
                                } else {
                                    if (Validator::make(['email' => $part], ['email' => ['required', 'string', 'max:254', 'email:rfc']])->fails()) {
                                        $this->error($rowNumber, $label, $part, __('leads.invalid_email'));
                                    }
                                    $record['emails'][] = mb_strtolower($part);
                                }
                            }
                            if (count($record[$field]) === $valueCount) {
                                $this->error($rowNumber, $label, $value, __('leads.empty_contact_values'));
                            }
                            break;
                    }
                }

                if ($record['name'] === '') {
                    $nameIndex = array_search('name', array_column($headers, 'field', 'index'), true);
                    $this->error($rowNumber, Coordinate::stringFromColumnIndex((int) $nameIndex + 1).' — '.$headers[$nameIndex]['label'], '', __('leads.name_required'));
                }
                foreach (['phones', 'emails'] as $field) {
                    $record[$field] = array_values(array_unique($record[$field]));
                    if (count($record[$field]) > 20) {
                        $this->error($rowNumber, __('leads.'.$field), '', __('leads.too_many_values'));
                    }
                }
                if (count($this->errors) === $before) {
                    $records[] = $record;
                }
                if (count($this->errors) >= self::MAX_ERRORS) {
                    break;
                }
            }
        } catch (LeadImportException $exception) {
            throw $exception;
        } catch (Throwable $exception) {
            report($exception);
            $this->fail(__('leads.unreadable_file'));
        }

        if ($headers === null) {
            $this->fail(__('leads.empty_file'));
        }
        if ($rowCount === 0 && $this->errors === []) {
            $this->error(2, '', '', __('leads.no_data_rows'));
        }
        if ($this->errors !== []) {
            throw new LeadImportException($this->errors);
        }

        return DB::transaction(function () use ($records): array {
            $categoryIds = array_values(array_unique(array_filter(array_column($records, 'lead_category_id'))));
            // Keep categories valid between validation and saving, including concurrent category deletion.
            if (LeadCategory::whereKey($categoryIds)->sharedLock()->get(['id'])->count() !== count($categoryIds)) {
                $this->fail(__('leads.categories_changed'));
            }

            $fingerprints = [];
            foreach (array_chunk(array_unique(array_column($records, 'name')), 500) as $names) {
                foreach (Lead::whereIn('name', $names)->get() as $existing) {
                    $fingerprints[LeadContactData::fingerprint($existing->attributesToArray())] = true;
                }
            }

            $created = 0;
            $skipped = 0;
            foreach ($records as $record) {
                $fingerprint = LeadContactData::fingerprint($record);
                if (isset($fingerprints[$fingerprint])) {
                    $skipped++;

                    continue;
                }
                Lead::create($record);
                $fingerprints[$fingerprint] = true;
                $created++;
            }

            return ['created' => $created, 'skipped' => $skipped];
        });
    }

    private function headers(array $cells): array
    {
        if (count($cells) > self::MAX_COLUMNS) {
            $this->fail(__('leads.too_many_columns'));
        }
        $aliases = [
            'name' => ['الاسم', 'اسم', 'الاسم الكامل', 'اسم جهة الاتصال', 'اسم العميل', 'name', 'full name', 'contact name', 'lead name'],
            'phones' => ['الهاتف', 'هاتف', 'أرقام الهاتف', 'رقم الهاتف', 'أرقام الهواتف', 'الهواتف', 'الجوال', 'جوال', 'أرقام الجوال', 'رقم الجوال', 'رقم التواصل', 'التلفون', 'phone', 'phones', 'phone number', 'phone numbers', 'mobile', 'mobiles', 'mobile number', 'telephone'],
            'emails' => ['البريد الإلكتروني', 'البريد الالكتروني', 'البريد', 'بريد إلكتروني', 'الإيميل', 'ايميل', 'البريد الإلكتروني المتعدد', 'عناوين البريد الإلكتروني', 'email', 'emails', 'e-mail', 'email address', 'email addresses'],
            'category' => ['التصنيف', 'تصنيف', 'الفئة', 'فئة', 'تصنيف جهة الاتصال', 'تصنيف العميل', 'category', 'lead category', 'contact category'],
            'notes' => ['ملاحظات', 'الملاحظات', 'ملاحظة', 'notes', 'note', 'comments'],
        ];
        $lookup = [];
        foreach ($aliases as $field => $names) {
            foreach ($names as $name) {
                $lookup[$this->normalizeHeader($name)] = $field;
            }
        }

        $headers = [];
        $seen = [];
        $singleFields = [];
        foreach ($cells as $index => $cell) {
            $label = LeadContactData::trim($cell['value']);
            if ($label === '') {
                $headers[$index] = null;

                continue;
            }
            $normalized = $this->normalizeHeader($label);
            $base = preg_replace('/\d+$/', '', $normalized);
            $field = $lookup[$normalized] ?? null;
            if ($field === null && in_array($lookup[$base] ?? null, ['phones', 'emails'], true)) {
                $field = $lookup[$base];
            }
            $column = Coordinate::stringFromColumnIndex($index + 1);
            if ($field === null) {
                $this->error(1, $column, $label, __('leads.unknown_header'));
            } elseif (isset($seen[$normalized]) || (! in_array($field, ['phones', 'emails'], true) && isset($singleFields[$field]))) {
                $this->error(1, $column, $label, __('leads.duplicate_header'));
            }
            $seen[$normalized] = true;
            if ($field !== null) {
                $singleFields[$field] = true;
                $headers[$index] = ['field' => $field, 'label' => $label, 'index' => $index];
            }
        }
        if (! isset($singleFields['name'])) {
            $this->error(1, '', '', __('leads.missing_name_header'));
        }

        return $headers;
    }

    private function normalizeHeader(string $value): string
    {
        $value = mb_strtolower(LeadContactData::digits($value));
        $value = strtr($value, ['أ' => 'ا', 'إ' => 'ا', 'آ' => 'ا']);

        return preg_replace('/[\s\p{Z}_\-()\x{0640}\x{064B}-\x{065F}\x{200E}\x{200F}\x{FEFF}]/u', '', $value) ?? $value;
    }

    private function excelRows(string $path): Generator
    {
        $reader = new Xlsx;
        if (! $reader->canRead($path)) {
            $this->fail(__('leads.unreadable_file'));
        }
        $sheets = $reader->listWorksheetInfo($path);
        if (count($sheets) !== 1) {
            $this->fail(__('leads.one_worksheet_only'));
        }
        $info = $sheets[0];
        if ($info['totalRows'] > self::MAX_ROWS + 1) {
            $this->fail(__('leads.too_many_rows'));
        }
        if ($info['totalColumns'] > self::MAX_COLUMNS) {
            $this->fail(__('leads.too_many_columns'));
        }
        $reader->setLoadSheetsOnly($info['worksheetName']);
        $reader->setReadDataOnly(false);
        $reader->setReadEmptyCells(false);
        $reader->setReadFilter(new class implements IReadFilter
        {
            public function readCell($columnAddress, $row, $worksheetName = ''): bool
            {
                return $row <= LeadSpreadsheetImporter::MAX_ROWS + 1
                    && Coordinate::columnIndexFromString($columnAddress) <= LeadSpreadsheetImporter::MAX_COLUMNS;
            }
        });
        $book = $reader->load($path);
        try {
            $sheet = $book->getSheet(0);
            if ($sheet->getMergeCells() !== []) {
                foreach ($sheet->getMergeCells() as $range) {
                    $boundaries = Coordinate::rangeBoundaries($range);
                    $this->error($boundaries[0][1], $range, '', __('leads.merged_cells'));
                }

                throw new LeadImportException($this->errors);
            }
            for ($row = 1; $row <= $info['totalRows']; $row++) {
                $cells = [];
                for ($column = 1; $column <= $info['totalColumns']; $column++) {
                    $cell = $sheet->getCell(Coordinate::stringFromColumnIndex($column).$row);
                    $value = $cell->getValue();
                    if ($value instanceof RichText) {
                        $value = $value->getPlainText();
                    }
                    $cells[] = ['value' => (string) ($value ?? ''), 'type' => $cell->getDataType()];
                }
                yield $row => $cells;
            }
        } finally {
            $book->disconnectWorksheets();
        }
    }

    private function csvRows(string $path, string $delimiter): Generator
    {
        // UTF-8 is explicit; guessing legacy encodings can silently corrupt Arabic names.
        if (! mb_check_encoding(file_get_contents($path), 'UTF-8')) {
            $this->fail(__('leads.csv_encoding'));
        }
        $handle = fopen($path, 'rb');
        try {
            if (fread($handle, 3) !== "\xEF\xBB\xBF") {
                rewind($handle);
            }
            $start = ftell($handle);
            $choices = ['comma' => ',', 'semicolon' => ';', 'tab' => "\t"];
            if ($delimiter === 'auto') {
                $counts = [];
                foreach ($choices as $key => $separator) {
                    fseek($handle, $start);
                    $counts[$key] = count(fgetcsv($handle, 0, $separator, '"', '') ?: []);
                }
                arsort($counts);
                $delimiter = array_key_first($counts);
            }
            if (! isset($choices[$delimiter])) {
                $this->fail(__('leads.invalid_delimiter'));
            }
            fseek($handle, $start);
            $row = 0;
            $width = null;
            while (true) {
                $recordStart = ftell($handle);
                $values = fgetcsv($handle, 0, $choices[$delimiter], '"', '');
                if ($values === false) {
                    break;
                }
                $row++;
                if ($row > self::MAX_ROWS + 1) {
                    $this->fail(__('leads.too_many_rows'), $row);
                }
                if (count($values) > self::MAX_COLUMNS) {
                    $this->fail(__('leads.too_many_columns'), $row);
                }
                $recordEnd = ftell($handle);
                fseek($handle, $recordStart);
                $raw = fread($handle, $recordEnd - $recordStart);
                fseek($handle, $recordEnd);
                if (! $this->validCsvRecord($raw, $choices[$delimiter])) {
                    $this->error($row, '', '', __('leads.csv_quotes'));
                }
                $cells = array_map(fn ($value): array => ['value' => (string) ($value ?? ''), 'type' => DataType::TYPE_STRING], $values);
                if ($row === 1) {
                    $width = count($values);
                } elseif (! $this->blank($cells) && count($values) !== $width) {
                    $this->error($row, '', '', __('leads.csv_column_count', ['expected' => $width, 'actual' => count($values)]));
                }
                yield $row => $cells;
            }
        } finally {
            fclose($handle);
        }
    }

    private function validCsvRecord(string $record, string $separator): bool
    {
        // fgetcsv tolerates broken quoting; reject it before it can silently change a contact.
        $separator = preg_quote($separator, '/');
        $field = '(?:"(?:[^"]++|"")*"|[^"'.$separator.'\r\n]*)';

        return preg_match('/\A'.$field.'(?:'.$separator.$field.')*(?:\r\n|\n|\r)?\z/s', $record) === 1;
    }

    private function blank(array $cells): bool
    {
        foreach ($cells as $cell) {
            if (LeadContactData::trim($cell['value']) !== '') {
                return false;
            }
        }

        return true;
    }

    private function error(int $row, string $column, string $value, string $message): void
    {
        if (count($this->errors) < self::MAX_ERRORS) {
            $this->errors[] = ['row' => $row, 'column' => $column, 'value' => mb_substr($value, 0, 500), 'message' => $message];
        }
    }

    private function fail(string $message, int $row = 1): never
    {
        $this->error($row, '', '', $message);

        throw new LeadImportException($this->errors);
    }
}
