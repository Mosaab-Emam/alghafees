<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogStaticContentResource\Pages;
use App\Filament\Resources\BlogStaticContentResource\RelationManagers;
use App\Models\BlogStaticContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogStaticContentResource extends Resource
{
    protected static ?string $model = BlogStaticContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الموقع (المحتوى الثابت)';

    protected static ?int $navigationSort = 7;

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
                Forms\Components\TextInput::make('blog_small_title')
                    ->label(__('static_content.common.bottom_small_title'))
                    ->required(),
                Forms\Components\TextInput::make('blog_main_title')
                    ->label(__('static_content.common.bottom_title'))
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
            'index' => Pages\ListBlogStaticContents::route('/'),
            'edit' => Pages\EditBlogStaticContent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return route(static::getRouteBaseName() . '.edit', 1);
    }

    public static function getModelLabel(): string
    {
        return __('static_content.blog.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('static_content.blog.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('static_content.blog.navigation_label');
    }
}
