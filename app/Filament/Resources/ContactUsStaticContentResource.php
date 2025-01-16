<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactUsStaticContentResource\Pages;
use App\Filament\Resources\ContactUsStaticContentResource\RelationManagers;
use App\Models\ContactUsStaticContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactUsStaticContentResource extends Resource
{
    protected static ?string $model = ContactUsStaticContent::class;

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
            'index' => Pages\ListContactUsStaticContents::route('/'),
            'edit' => Pages\EditContactUsStaticContent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return route(static::getRouteBaseName() . '.edit', 1);
    }

    public static function getModelLabel(): string
    {
        return __('static_content.contact-us.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('static_content.contact-us.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('static_content.contact-us.navigation_label');
    }
}
