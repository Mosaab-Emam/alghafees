<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeStaticContentResource\Pages;
use App\Filament\Resources\HomeStaticContentResource\RelationManagers;
use App\Models\HomeStaticContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HomeStaticContentResource extends Resource
{
    protected static ?string $model = HomeStaticContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الموقع (المحتوى الثابت)';

    public static function getNavigationUrl(): string
    {
        return route(static::getRouteBaseName() . '.edit', 1);
    }

    public static function getModelLabel(): string
    {
        return __('static_content.home.model_label');
    }

    public static function getNavigationLabel(): string
    {

        return __('static_content.home.navigation_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('hero_small_top_title')
                    ->label(__('static_content.home.hero_small_top_title'))
                    ->columnStart(1)
                    ->required(),
                Forms\Components\TextInput::make('hero_main_title')
                    ->label(__('static_content.home.hero_main_title'))
                    ->required(),
                Forms\Components\Textarea::make('hero_description')
                    ->label(__('static_content.home.hero_description'))
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\TextInput::make('hero_main_button_text')
                    ->label(__('static_content.home.hero_main_button_text'))
                    ->required(),
                Forms\Components\TextInput::make('hero_main_button_link')
                    ->label(__('static_content.home.hero_main_button_link'))
                    ->required(),
                Forms\Components\TextInput::make('hero_secondary_button_text')
                    ->label(__('static_content.home.hero_secondary_button_text'))
                    ->required(),
                Forms\Components\TextInput::make('hero_secondary_button_link')
                    ->label(__('static_content.home.hero_secondary_button_link'))
                    ->required(),
                Forms\Components\TextInput::make('hero_download_box_text')
                    ->label(__('static_content.home.hero_download_box_text'))
                    ->required(),
                Forms\Components\TextInput::make('hero_vertical_text')
                    ->label(__('static_content.home.hero_vertical_text'))
                    ->required(),
                Forms\Components\TextInput::make('hero_x_link')
                    ->label(__('static_content.home.hero_x_link'))
                    ->required(),
                Forms\Components\TextInput::make('hero_linkedin_link')
                    ->label(__('static_content.home.hero_linkedin_link'))
                    ->required(),
                Forms\Components\TextInput::make('hero_youtube_link')
                    ->label(__('static_content.home.hero_youtube_link'))
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
            'index' => Pages\ListHomeStaticContents::route('/'),
            'edit' => Pages\EditHomeStaticContent::route('/{record}/edit'),
        ];
    }
}
