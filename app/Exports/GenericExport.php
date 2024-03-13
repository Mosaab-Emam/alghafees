<?php

namespace App\Exports;

use App\Models\RateRequest;
use Carbon\Carbon;
use Filament\Actions\Exports\ExportColumn;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Str;

class GenericExport extends DefaultValueBinder implements FromCollection,ShouldAutoSize,WithHeadings
    , WithMapping , WithDefaultStyles , WithCustomValueBinder , WithStrictNullComparison
{

    protected Collection $data;

    public array $columns = [];


    public array $fields = [];

    public function  __construct($selectedRows,$columns,$fields) {

        $this->data = $selectedRows;
        $this->columns = $columns;
        $this->fields = $fields;
    }

    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        return $this->data;
    }

    public function headings() : array
    {
        return $this->columns;
    }
    public function map($row) : array
    {
        $mappedData = [];

        foreach ($this->fields as $field) {
            if (Str::contains($field,'.')) {
                [$relation,$attribute] = explode('.',$field);

                $mappedData[] = $row?->$relation?->$attribute ;
            }
            else {

                $mappedData[] =  $row?->$field;
            }

        }

        return $mappedData;
    }


    public function defaultStyles(Style $defaultStyle)
    {
        return  [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => false,
            ],
            'quotePrefix'    => false
        ];
    }

    public function bindValue(Cell $cell, $value)
    {

            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;


    }
}
