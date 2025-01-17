<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutUsStaticContentResource\Pages;
use App\Filament\Resources\AboutUsStaticContentResource\RelationManagers;
use App\Models\AboutUsStaticContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutUsStaticContentResource extends Resource
{
    protected static ?string $model = AboutUsStaticContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الموقع (المحتوى الثابت)';

    protected static ?int $navigationSort = 2;

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
                Forms\Components\TextInput::make('about_top_title')
                    ->label(__('static_content.about-us.about_top_title'))
                    ->required(),
                Forms\Components\TextInput::make('about_first_title')
                    ->label(__('static_content.about-us.about_first_title'))
                    ->required()
                    ->columnStart(1),
                Forms\Components\Textarea::make('about_first_description')
                    ->label(__('static_content.about-us.about_first_description'))
                    ->required(),
                Forms\Components\TextInput::make('about_second_title')
                    ->label(__('static_content.about-us.about_second_title'))
                    ->required(),
                Forms\Components\Textarea::make('about_second_description')
                    ->label(__('static_content.about-us.about_second_description'))
                    ->required(),
                Forms\Components\TextInput::make('management_title')
                    ->label(__('static_content.about-us.management_title'))
                    ->required(),
                Forms\Components\Textarea::make('management_description')
                    ->label(__('static_content.about-us.management_description'))
                    ->required(),
                Forms\Components\TextInput::make('feat1_title')
                    ->label(__('static_content.about-us.feat1_title'))
                    ->required(),
                Forms\Components\Textarea::make('feat1_description')
                    ->label(__('static_content.about-us.feat1_description'))
                    ->required(),
                Forms\Components\TextInput::make('feat2_title')
                    ->label(__('static_content.about-us.feat2_title'))
                    ->required(),
                Forms\Components\Textarea::make('feat2_description')
                    ->label(__('static_content.about-us.feat2_description'))
                    ->required(),
                Forms\Components\TextInput::make('feat3_title')
                    ->label(__('static_content.about-us.feat3_title'))
                    ->required(),
                Forms\Components\Textarea::make('feat3_description')
                    ->label(__('static_content.about-us.feat3_description'))
                    ->required(),
                Forms\Components\TextInput::make('vision_title')
                    ->label(__('static_content.about-us.vision_title'))
                    ->required(),
                Forms\Components\Textarea::make('vision_description')
                    ->label(__('static_content.about-us.vision_description'))
                    ->required(),
                Forms\Components\TextInput::make('message_title')
                    ->label(__('static_content.about-us.message_title'))
                    ->required(),
                Forms\Components\Textarea::make('message_description')
                    ->label(__('static_content.about-us.message_description'))
                    ->required(),
                Forms\Components\TextInput::make('reports_title')
                    ->label(__('static_content.about-us.reports_title'))
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
            'index' => Pages\ListAboutUsStaticContents::route('/'),
            'edit' => Pages\EditAboutUsStaticContent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return route(static::getRouteBaseName() . '.edit', 1);
    }

    public static function getModelLabel(): string
    {
        return __('static_content.about-us.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('static_content.about-us.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('static_content.about-us.navigation_label');
    }
}
