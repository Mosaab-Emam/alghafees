<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrackYourRequestStaticContentResource\Pages;
use App\Filament\Resources\TrackYourRequestStaticContentResource\RelationManagers;
use App\Models\TrackYourRequestStaticContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrackYourRequestStaticContentResource extends Resource
{
    protected static ?string $model = TrackYourRequestStaticContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الموقع (المحتوى الثابت)';

    protected static ?int $navigationSort = 9;

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
                Forms\Components\TextInput::make('title')
                    ->label(__('static_content.common.main_title'))
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label(__('static_content.common.main_description'))
                    ->required(),
                Forms\Components\TextInput::make('search_placeholder')
                    ->label(__('static_content.track-your-request.search_placeholder'))
                    ->required(),
                Forms\Components\TextInput::make('btn_text')
                    ->label(__('static_content.common.cta_text'))
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
            'index' => Pages\ListTrackYourRequestStaticContents::route('/'),
            'edit' => Pages\EditTrackYourRequestStaticContent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return route(static::getRouteBaseName() . '.edit', 1);
    }

    public static function getModelLabel(): string
    {
        return __('static_content.track-your-request.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('static_content.track-your-request.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('static_content.track-your-request.navigation_label');
    }
}
