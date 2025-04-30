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

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('static_content.home.hero.section_title'))
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('hero_small_top_title')
                            ->label(__('static_content.home.hero.small_top_title'))
                            ->columnStart(1)
                            ->required(),
                        Forms\Components\TextInput::make('hero_main_title')
                            ->label(__('static_content.home.hero.main_title'))
                            ->required(),
                        Forms\Components\Textarea::make('hero_description')
                            ->label(__('static_content.home.hero.description'))
                            ->columnSpanFull()
                            ->required(),
                        Forms\Components\TextInput::make('hero_main_button_text')
                            ->label(__('static_content.home.hero.main_button_text'))
                            ->required(),
                        Forms\Components\TextInput::make('hero_main_button_link')
                            ->label(__('static_content.home.hero.main_button_link'))
                            ->required(),
                        Forms\Components\TextInput::make('hero_secondary_button_text')
                            ->label(__('static_content.home.hero.secondary_button_text'))
                            ->required(),
                        Forms\Components\TextInput::make('hero_secondary_button_link')
                            ->label(__('static_content.home.hero.secondary_button_link'))
                            ->required(),
                        Forms\Components\TextInput::make('hero_download_box_text')
                            ->label(__('static_content.home.hero.download_box_text'))
                            ->required(),
                        Forms\Components\TextInput::make('hero_vertical_text')
                            ->label(__('static_content.home.hero.vertical_text'))
                            ->required(),
                    ]),

                Forms\Components\Section::make(__('static_content.home.about.section_title'))
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('about_small_top_title')
                            ->label(__('static_content.home.about.small_top_title'))
                            ->required(),
                        Forms\Components\TextInput::make('about_big_top_title')
                            ->label(__('static_content.home.about.big_top_title'))
                            ->required(),
                        Forms\Components\TextInput::make('about_main_title')
                            ->label(__('static_content.home.about.main_title'))
                            ->required(),
                        Forms\Components\Textarea::make('about_description')
                            ->label(__('static_content.home.about.description'))
                            ->columnSpanFull()
                            ->required(),
                        Forms\Components\TextInput::make('about_feat1_title')
                            ->label(__('static_content.home.about.feat1_title'))
                            ->required(),
                        Forms\Components\Textarea::make('about_feat1_description')
                            ->label(__('static_content.home.about.feat1_description'))
                            ->required(),
                        Forms\Components\TextInput::make('about_feat2_title')
                            ->label(__('static_content.home.about.feat2_title'))
                            ->required(),
                        Forms\Components\Textarea::make('about_feat2_description')
                            ->label(__('static_content.home.about.feat2_description'))
                            ->required(),
                        Forms\Components\TextInput::make('about_feat3_title')
                            ->label(__('static_content.home.about.feat3_title'))
                            ->required(),
                        Forms\Components\Textarea::make('about_feat3_description')
                            ->label(__('static_content.home.about.feat3_description'))
                            ->required(),
                        Forms\Components\TextInput::make('about_button_text')
                            ->label(__('static_content.home.about.button_text'))
                            ->required(),
                        Forms\Components\TextInput::make('about_button_link')
                            ->label(__('static_content.home.about.button_link'))
                            ->required(),
                    ]),

                Forms\Components\Section::make(__('static_content.home.our-services.section_title'))
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('services_small_top_title')
                            ->label(__('static_content.home.our-services.small_top_title'))
                            ->required(),
                        Forms\Components\TextInput::make('services_main_title')
                            ->label(__('static_content.home.our-services.main_title'))
                            ->required(),
                        Forms\Components\Textarea::make('services_description')
                            ->label(__('static_content.home.our-services.description'))
                            ->columnSpanFull()
                            ->required(),
                        Forms\Components\TextInput::make('services_button_text')
                            ->label(__('static_content.home.our-services.button_text'))
                            ->required(),
                        Forms\Components\TextInput::make('services_button_link')
                            ->label(__('static_content.home.our-services.button_link'))
                            ->required(),
                        Forms\Components\TextInput::make('services_stat1_number')
                            ->label(__('static_content.home.our-services.stat1_number'))
                            ->required(),
                        Forms\Components\TextInput::make('services_stat1_text')
                            ->label(__('static_content.home.our-services.stat1_text'))
                            ->required(),
                        Forms\Components\TextInput::make('services_stat2_number')
                            ->label(__('static_content.home.our-services.stat2_number'))
                            ->required(),
                        Forms\Components\TextInput::make('services_stat2_text')
                            ->label(__('static_content.home.our-services.stat2_text'))
                            ->required(),
                        Forms\Components\TextInput::make('services_stat3_number')
                            ->label(__('static_content.home.our-services.stat3_number'))
                            ->required(),
                        Forms\Components\TextInput::make('services_stat3_text')
                            ->label(__('static_content.home.our-services.stat3_text'))
                            ->required(),
                        Forms\Components\TextInput::make('services_events_small_top_title')
                            ->label(__('static_content.home.our-services.events_small_top_title'))
                            ->required(),
                        Forms\Components\TextInput::make('services_events_main_title')
                            ->label(__('static_content.home.our-services.events_main_title'))
                            ->required(),
                        Forms\Components\TextInput::make('services_events_video_url')
                            ->label(__('static_content.home.our-services.events_video_url'))
                            ->required(),
                        Forms\Components\TextInput::make('services_events_button_text')
                            ->label(__('static_content.home.our-services.events_button_text'))
                            ->required()
                            ->columnStart(1),
                        Forms\Components\TextInput::make('services_events_button_link')
                            ->label(__('static_content.home.our-services.events_button_link'))
                            ->required(),
                    ]),

                Forms\Components\Section::make(__('static_content.home.our-clients.section_title'))
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('clients_small_top_title')
                            ->label(__('static_content.home.our-clients.small_top_title'))
                            ->required(),
                        Forms\Components\TextInput::make('clients_main_title')
                            ->label(__('static_content.home.our-clients.main_title'))
                            ->required(),
                        Forms\Components\Textarea::make('clients_description')
                            ->label(__('static_content.home.our-clients.description'))
                            ->columnSpanFull()
                            ->required(),
                        Forms\Components\TextInput::make('clients_button_text')
                            ->label(__('static_content.home.our-clients.button_text'))
                            ->required(),
                        Forms\Components\TextInput::make('clients_button_link')
                            ->label(__('static_content.home.our-clients.button_link'))
                            ->required(),
                    ]),
                Forms\Components\Section::make(__('static_content.home.contact-us.section_title'))
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('contact_us_small_top_title')
                            ->label(__('static_content.home.contact-us.small_top_title'))
                            ->required(),
                        Forms\Components\TextInput::make('contact_us_main_title')
                            ->label(__('static_content.home.contact-us.main_title'))
                            ->required(),
                        Forms\Components\TextInput::make('contact_us_form_title')
                            ->label(__('static_content.home.contact-us.form_title'))
                            ->required(),
                        Forms\Components\Textarea::make('contact_us_form_description')
                            ->label(__('static_content.home.contact-us.form_description'))
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
            'index' => Pages\ListHomeStaticContents::route('/'),
            'edit' => Pages\EditHomeStaticContent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return route(static::getRouteBaseName() . '.edit', 1);
    }

    public static function getModelLabel(): string
    {
        return __('static_content.home.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('static_content.home.model_label');
    }

    public static function getNavigationLabel(): string
    {

        return __('static_content.home.navigation_label');
    }
}
