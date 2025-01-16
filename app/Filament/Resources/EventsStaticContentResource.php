<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventsStaticContentResource\Pages;
use App\Filament\Resources\EventsStaticContentResource\RelationManagers;
use App\Models\EventsStaticContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventsStaticContentResource extends Resource
{
    protected static ?string $model = EventsStaticContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الموقع (المحتوى الثابت)';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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
            'index' => Pages\ListEventsStaticContents::route('/'),
            'edit' => Pages\EditEventsStaticContent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return route(static::getRouteBaseName() . '.edit', 1);
    }

    public static function getModelLabel(): string
    {
        return __('static_content.events.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('static_content.events.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('static_content.events.navigation_label');
    }
}
