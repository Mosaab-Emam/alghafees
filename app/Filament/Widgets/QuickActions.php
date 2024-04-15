<?php

namespace App\Filament\Widgets;

use App\Helpers\MYPDF;
use App\Models\Category;
use Filament\Widgets\Widget;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Filament\Forms\Components\Grid;

class QuickActions extends Widget implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static bool $isLazy = false;

    protected static string $view = 'filament.widgets.quick-actions-widget';

    public function testAction(): Action
    {
        return Action::make('test')
            ->label(__('actions.create_price_offer_pdf'))
            ->icon('heroicon-o-paper-clip')
            ->color('gray')
            ->outlined()
            ->modalSubmitActionLabel(__('actions.create_price_offer_pdf'))
            ->slideOver()
            ->form([
                Grid::make(2)
                    ->schema([
                        Select::make('title')
                            ->label(__('اللقب'))
                            ->options([
                                'السيد',
                                'السادة'
                            ])
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('client_name')
                            ->label('اسم العميل')
                            ->required(),
                        TextInput::make('serial')
                            ->label('الرقم التسلسلي')
                            ->required(),
                        TextInput::make('general_type')
                            ->label('النوع')
                            ->required(),
                        TextInput::make('city')
                            ->label('المدينة')
                            ->required(),
                        TextInput::make('area')
                            ->label('الحي')
                            ->required(),
                        TextInput::make('purpose')
                            ->label('الغرض من التقييم')
                            ->required(),
                        TextInput::make('duration')
                            ->label('مدة الانجاز')
                            ->default(15)
                            ->numeric()
                            ->suffix('يوم عمل')
                            ->required(),
                        Select::make('groups.0.type')
                            ->label(__('نوع العقار'))
                            ->options(Category::where('type', 1)->pluck('title', 'title'))
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('groups.0.number')
                            ->label('رقم الصك')
                            ->required(),
                        TextInput::make('groups.0.price')
                            ->label('الاتعاب')
                            ->numeric()
                            ->afterStateUpdated(function (Set $set, $state) {
                                $set('groups.0.total', round($state * 1.15, 2));
                                $set('groups.0.tax', round($state * 0.15, 2));
                            })
                            ->live(onBlur: true)
                            ->suffix('ريال سعودي')
                            ->required(),
                        TextInput::make('groups.0.tax')
                            ->label('الضريبة 15%')
                            ->default(0)
                            ->readOnly(),
                        TextInput::make('groups.0.total')
                            ->label('المجموع')
                            ->default(0)
                            ->readOnly(),
                        TextInput::make('price_in_words')
                            ->label('السعر كتابة')
                            ->required(),
                    ])
            ])
            ->action(function (array $data) {
                return MYPDF::generate($data);
            });
    }
}
