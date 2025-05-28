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

    protected static ?int $navigationSort = 6;

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
                Forms\Components\TextInput::make('video_url')
                    ->label(__('static_content.events.video_url'))
                    ->required(),
                Forms\Components\TextInput::make('events_title')
                    ->label(__('static_content.common.bottom_title'))
                    ->required(),
                Forms\Components\Textarea::make('events_empty_text')
                    ->label(__('static_content.events.events_empty_text'))
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
