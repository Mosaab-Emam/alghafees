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

    protected static ?int $navigationSort = 8;

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
                Forms\Components\TextInput::make('form_title')
                    ->label(__('static_content.contact-us.form_title'))
                    ->required(),
                Forms\Components\Textarea::make('form_description')
                    ->label(__('static_content.contact-us.form_description'))
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->label(__('static_content.common.main_title'))
                    ->required(),
                Forms\Components\TextInput::make('box_title')
                    ->label(__('static_content.contact-us.box_title'))
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->label(__('static_content.contact-us.phone'))
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label(__('static_content.contact-us.email'))
                    ->required(),
                Forms\Components\TextInput::make('cta_text')
                    ->label(__('static_content.common.cta_text'))
                    ->required(),
                Forms\Components\TextInput::make('cta_link')
                    ->label(__('static_content.common.cta_link'))
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
