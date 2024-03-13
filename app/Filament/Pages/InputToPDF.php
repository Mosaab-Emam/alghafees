<?php

namespace App\Filament\Pages;

use App\Helpers\MYPDF;
use App\Http\Controllers\Admin\PrivacyController;
use App\Models\Category;
use App\Models\Setting;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Pages\Page;


class InputToPDF extends Page implements HasForms
{

    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';

    protected static string $view = 'filament.pages.input-to-p-d-f';

    protected static ?int $navigationSort = 2;

    protected ?string $heading = '';

    public ?array $data = [];

    public static function getNavigationLabel(): string
    {
        return __('admin.price_offer');
    }
    public function getTitle(): string
    {
        return __('admin.price_offer');
    }

    protected static ?string $slug = 'price-offer';



    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('عرض سعر')->columns([
                    'sm' => 2
                ])->extraAttributes(['style' => 'background : transparent; box-shadow : none'])
                    ->schema([
                        Select::make('title')->label(__('اللقب'))
                            ->options([
                                'السيد',
                                'السادة'
                            ])
                            ->required(),
                        TextInput::make('client_name')->label('اسم العميل')
                            ->required(),
                        TextInput::make('serial')->label('الرقم التسلسلي')
                            ->required(),
                        TextInput::make('general_type')->label('النوع')
                            ->required(),

                        TextInput::make('city')->label('المدينة')
                            ->required(),
                        TextInput::make('area')->label('الحي')
                            ->required(),
                        TextInput::make('purpose')->label('الغرض من التقييم')
                            ->required(),
                        TextInput::make('duration')->label('مدة الانجاز')
                            ->default(15)
                            ->numeric()
                            ->required(),
                    ]),
                Section::make('التفاصيل')->columns([
                    'sm' => 2
                ])->extraAttributes(['style' => 'background : transparent; box-shadow : none'])
                    ->schema([
                        Select::make('groups.0.type')->label(__('نوع العقار'))
                            ->options(Category::where('type',1)->pluck('title','title'))
                            ->required(),
                        TextInput::make('groups.0.number')->label('رقم الصك')
                            ->required(),
                        TextInput::make('groups.0.price')->label('الاتعاب')
                            ->numeric()
                            ->afterStateUpdated(function (Set $set,$state) {
                                $set('groups.0.total', round($state * 1.15,2));
                                $set('groups.0.tax',round($state * 0.15,2));
                            })
                            ->live(onBlur: true)
                            ->required(),
                        TextInput::make('groups.0.tax')->label('الضريبة 15%')->default(0)->readOnly(),
                        TextInput::make('groups.0.total')->label('المجموع')->default(0)->readOnly(),
                        TextInput::make('price_in_words')->label('السعر بالكلمات')
                            ->columnStart(1)
                            ->required(),
                    ])

            ])->statePath('data');

    }


    public function create()
    {
        return MYPDF::generate($this->form->getState());
    }



}
