<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqStaticContentsResource\Pages;
use App\Models\FaqStaticContents;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Resources\Resource;

class FaqStaticContentsResource extends Resource
{
    protected static ?string $model = FaqStaticContents::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الموقع (المحتوى الثابت)';

    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('small_top_title')
                    ->label(__('static_content.common.small_top_title'))
                    ->required(),
                Forms\Components\TextInput::make('main_top_title')
                    ->label(__('static_content.common.main_top_title'))
                    ->required(),
                Forms\Components\RichEditor::make('content')
                    ->label(__('static_content.faq.content'))
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFaqStaticContents::route('/'),
            'edit' => Pages\EditFaqStaticContents::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return route(static::getRouteBaseName() . '.edit', 1);
    }

    public static function getModelLabel(): string
    {
        return __('static_content.faq.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('static_content.faq.model_label');
    }

    public static function getNavigationLabel(): string
    {

        return __('static_content.faq.navigation_label');
    }
}
