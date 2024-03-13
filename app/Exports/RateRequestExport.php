<?php

namespace App\Exports;

use App\Models\RateRequest;
use Carbon\Carbon;
use Filament\Actions\Exports\ExportColumn;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RateRequestExport implements FromCollection,ShouldAutoSize,WithHeadings , WithMapping , WithDefaultStyles
{

    protected Collection $data;

    public function  __construct($selectedRows) {

        $this->data = $selectedRows;
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
        return [
            __('admin.LastUpdate'),
            __('admin.Notes'),
            __('admin.Status'),
            __('admin.ApartmentDetail'),
            __('admin.Customer'),
            __('admin.RatesNo'),
        ];
    }
    public function map($row) : array
    {
        return [
            $row->updated_at,
            $row->notes,
            $row->statusTitle,
            $row->ApartmentTitleSpan,
            $row->clientTitleSpan,
            $row->request_no
        ];
    }


    public function defaultStyles(Style $defaultStyle)
    {
        return  [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'quotePrefix'    => true
        ];
    }
}
