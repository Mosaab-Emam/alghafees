<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JoinUsStaticContentResource\Pages;
use App\Filament\Resources\JoinUsStaticContentResource\RelationManagers;
use App\Models\JoinUsStaticContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JoinUsStaticContentResource extends Resource
{
    protected static ?string $model = JoinUsStaticContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الموقع (المحتوى الثابت)';

    protected static ?int $navigationSort = 10;

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
                    ->label(__('static_content.common.form_title'))
                    ->required(),
                Forms\Components\Textarea::make('form_description')
                    ->label(__('static_content.common.form_description'))
                    ->required(),
                Forms\Components\TextInput::make('form_btn_text')
                    ->label(__('static_content.common.form_btn_text'))
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->label(__('static_content.common.main_title'))
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label(__('static_content.common.main_description'))
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
            'index' => Pages\ListJoinUsStaticContents::route('/'),
            'edit' => Pages\EditJoinUsStaticContent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return route(static::getRouteBaseName() . '.edit', 1);
    }

    public static function getModelLabel(): string
    {
        return __('static_content.join-us.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('static_content.join-us.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('static_content.join-us.navigation_label');
    }
}
