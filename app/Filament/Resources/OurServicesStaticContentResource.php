<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurServicesStaticContentResource\Pages;
use App\Filament\Resources\OurServicesStaticContentResource\RelationManagers;
use App\Models\OurServicesStaticContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OurServicesStaticContentResource extends Resource
{
    protected static ?string $model = OurServicesStaticContent::class;

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
            'index' => Pages\ListOurServicesStaticContents::route('/'),
            'edit' => Pages\EditOurServicesStaticContent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return route(static::getRouteBaseName() . '.edit', 1);
    }

    public static function getModelLabel(): string
    {
        return __('static_content.our-services.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('static_content.our-services.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('static_content.our-services.navigation_label');
    }
}
