<?php

namespace App\Livewire;

use App\Helpers\MYPDF;
use Illuminate\Contracts\View\View;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;
use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\Filter\FilterException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfTypeException;
use setasign\Fpdi\PdfReader\PdfReaderException;
use setasign\Fpdi\Tcpdf\Fpdi;

class GeneratePdf extends Component
{


    public ?string $client_name = '';
    public ?string $title = '';
    public ?string $purpose = '';
    public ?string $city = '';
    public ?string $area = '';
    public ?string $serial = '';
    public $duration = 15;
    public ?string $general_type = '';
    public ?string $price_in_words = '';

    public array $groups = [
        [
            'number' => '',
            'type' => '',
            'price',
            'tax' => 0,
            'total' => 0
        ]
    ];

    public function addMore(): void
    {
        $this->groups[] = [
            'number' => '',
            'type' => '',
            'price',
        ];
    }

    public function removeGroup($index): void
    {
        if (count($this->groups) != 1) {
            array_splice($this->groups, $index, 1);
        }
    }

    #[NoReturn] public function updatedGroups($value, $key): void
    {
        [$index, $key] = explode('.', $key);
        if ($key == 'price') {
            $this->groups[$index]['tax'] = $this->groups[$index]['price'] * 0.15;
            $this->groups[$index]['total'] = ($this->groups[$index]['price'] * 0.15) + $this->groups[$index]['price'];
        }
    }

    public function submit() {
        $this->validate([
            'title' => 'required',
            'client_name' => 'required',
            'purpose' => 'required',
            'city' => 'required',
            'area' => 'required',
            'serial' => 'required',
            'general_type' => 'required',
            'price_in_words' => 'required',
            'groups.*.number' => 'required',
            'groups.*.type' => 'required',
            'groups.*.price' => 'required|numeric',
            'duration' => 'required|numeric',
        ], [], [
            'title' => 'اللقب',
            'client_name' => 'اسم العميل',
            'purpose' => 'الغرض من التحويل',
            'city' => 'المدينة',
            'area' => 'الحي',
            'serial' => 'الرقم التسلسلي',
            'general_type' => 'الغرض من التقييم',
            'price_in_words' => 'السعر بالكلمات',
            'groups.*.number' => 'رقم الصك',
            'groups.*.type' => 'نوع العقار',
            'groups.*.price' => 'السعر',
            'duration' => 'مدة الانجاز'
        ]);

        $data = [
            'title' => $this->title,
            'client_name' => $this->client_name,
            'purpose' => $this->purpose,
            'city' => $this->city,
            'area' => $this->area,
            'serial' => $this->serial,
            'general_type' => $this->general_type,
            'price_in_words' => $this->price_in_words,
            'groups' => [
                [
                    'number' => $this->groups[0]['number'],
                    'type' => $this->groups[0]['type'],
                    'price' => $this->groups[0]['price'],
                    'tax' => $this->groups[0]['tax'],
                    'total' => $this->groups[0]['total'],
                ]
            ],
            'duration' => $this->duration
        ];

        return MYPDF::generate($data);
    }



    public function render(): View
    {
        return view('livewire.generate-pdf');
    }
}
