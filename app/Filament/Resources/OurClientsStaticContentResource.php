<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurClientsStaticContentResource\Pages;
use App\Filament\Resources\OurClientsStaticContentResource\RelationManagers;
use App\Models\OurClientsStaticContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OurClientsStaticContentResource extends Resource
{
    protected static ?string $model = OurClientsStaticContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الموقع (المحتوى الثابت)';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('small_top_title')
                    ->label(__('static_content.our-clients.small_top_title'))
                    ->required(),
                Forms\Components\TextInput::make('main_top_title')
                    ->label(__('static_content.our-clients.main_top_title'))
                    ->required(),
                Forms\Components\TextInput::make('main_title')
                    ->label(__('static_content.our-clients.main_title'))
                    ->required(),
                Forms\Components\Textarea::make('main_description')
                    ->label(__('static_content.our-clients.main_description'))
                    ->required(),
                Forms\Components\TextInput::make('clients_title')
                    ->label(__('static_content.our-clients.clients_title'))
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
            'index' => Pages\ListOurClientsStaticContents::route('/'),
            'edit' => Pages\EditOurClientsStaticContent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return route(static::getRouteBaseName() . '.edit', 1);
    }

    public static function getModelLabel(): string
    {
        return __('static_content.our-clients.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('static_content.our-clients.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('static_content.our-clients.navigation_label');
    }
}
