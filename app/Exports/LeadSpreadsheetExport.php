<?php

namespace App\Exports;

use App\Models\Lead;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LeadSpreadsheetExport extends DefaultValueBinder implements FromCollection, ShouldAutoSize, WithCustomValueBinder, WithHeadings, WithStyles
{
    public function __construct(private Collection $rows, private array $headers) {}

    public static function contacts(Collection $leads): self
    {
        return new self($leads->map(fn (Lead $lead): array => [
            $lead->name, implode(' | ', $lead->phones ?? []), implode(' | ', $lead->emails ?? []),
            $lead->category?->name, $lead->notes,
        ]), self::contactHeaders());
    }

    public static function template(): self
    {
        return new self(collect(), self::contactHeaders());
    }

    public static function errors(array $errors): self
    {
        return new self(collect($errors)->map(fn (array $error): array => [
            $error['row'], $error['column'], $error['value'], $error['message'],
        ]), [__('leads.error_row'), __('leads.error_column'), __('leads.error_value'), __('leads.error_message')]);
    }

    private static function contactHeaders(): array
    {
        // A stable Arabic interchange format, independent of the dashboard's selected locale.
        return ['الاسم', 'أرقام الهاتف', 'البريد الإلكتروني', 'التصنيف', 'ملاحظات'];
    }

    public function collection(): Collection
    {
        return $this->rows;
    }

    public function headings(): array
    {
        return $this->headers;
    }

    public function bindValue(Cell $cell, $value): bool
    {
        // Preserve leading zeros and plus signs, and never turn user content into spreadsheet formulas.
        $cell->setValueExplicit((string) ($value ?? ''), DataType::TYPE_STRING);

        return true;
    }

    public function styles(Worksheet $sheet): array
    {
        $sheet->setRightToLeft(true);
        $sheet->freezePane('A2');
        $sheet->setAutoFilter($sheet->calculateWorksheetDimension());
        $sheet->getStyle($sheet->calculateWorksheetDimension())->getAlignment()->setWrapText(true);

        return [1 => ['font' => ['bold' => true]]];
    }
}
