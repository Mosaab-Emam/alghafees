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
