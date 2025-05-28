<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PricingStaticContentResource\Pages;
use App\Models\PricingStaticContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;

class PricingStaticContentResource extends Resource
{
    protected static ?string $model = PricingStaticContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الموقع (المحتوى الثابت)';

    protected static ?int $navigationSort = 12;

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
                Forms\Components\Section::make('القسم العلوي')
                    ->columns(2)
                    ->schema([
                        Forms\Components\FileUpload::make('hero_image')
                            ->label(__('static_content.pricing.hero_image'))
                            ->columnSpanFull()
                            ->required(),
                        Forms\Components\TextInput::make('hero_title')
                            ->label(__('static_content.pricing.hero_title'))
                            ->required(),
                        Forms\Components\Textarea::make('hero_description')
                            ->label(__('static_content.pricing.hero_description'))
                            ->required(),
                        Forms\Components\TextInput::make('hero_goals_title')
                            ->label(__('static_content.pricing.hero_goals_title'))
                            ->required(),
                        Forms\Components\Repeater::make('hero_goals')
                            ->label(__('static_content.pricing.hero_goals'))
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label(__('static_content.pricing.hero_goal_title'))
                                    ->required(),
                            ])
                    ]),
                Forms\Components\Section::make('القسم الثاني')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('payment_title')
                            ->label(__('static_content.pricing.payment_title'))
                            ->required(),
                        Forms\Components\Textarea::make('payment_description')
                            ->label(__('static_content.pricing.payment_description'))
                            ->required(),
                        Forms\Components\Textarea::make('contact_description')
                            ->label(__('static_content.pricing.contact_description'))
                            ->required(),
                    ]),
                Forms\Components\Section::make('قسم الحزم')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('packages_title')
                            ->label(__('static_content.pricing.packages_title'))
                            ->required(),
                        Forms\Components\Textarea::make('packages_description')
                            ->label(__('static_content.pricing.packages_description'))
                            ->required(),
                    ]),
                Forms\Components\Section::make('قسم البانر')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('banner_title')
                            ->label(__('static_content.pricing.banner_title'))
                            ->required(),
                        Forms\Components\TextInput::make('banner_subtitle')
                            ->label(__('static_content.pricing.banner_subtitle'))
                            ->required(),
                        Forms\Components\Textarea::make('banner_description')
                            ->label(__('static_content.pricing.banner_description'))
                            ->required(),
                        Forms\Components\TextInput::make('banner_button_text')
                            ->label(__('static_content.pricing.banner_button_text'))
                            ->required(),
                    ]),
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
            'index' => Pages\ListPricingStaticContents::route('/'),
            'edit' => Pages\EditPricingStaticContent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return route(static::getRouteBaseName() . '.edit', 1);
    }

    public static function getModelLabel(): string
    {
        return __('static_content.pricing.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('static_content.pricing.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('static_content.pricing.navigation_label');
    }
}
