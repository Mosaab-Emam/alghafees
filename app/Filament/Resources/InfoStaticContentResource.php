<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InfoStaticContentResource\Pages;
use App\Filament\Resources\InfoStaticContentResource\RelationManagers;
use App\Models\InfoStaticContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InfoStaticContentResource extends Resource
{
    protected static ?string $model = InfoStaticContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الموقع (المحتوى الثابت)';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->label('الوصف')
                    ->columnStart(1)
                    ->required(),
                Forms\Components\TextInput::make('info_section_title')
                    ->label('عنوان قسم المعلومات')
                    ->required(),
                Forms\Components\TextInput::make('work_hours')
                    ->label('ساعات العمل')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('phone_number')
                    ->label('رقم الهاتف')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('whatsapp_number')
                    ->label('رقم الواتساب')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('address_1')
                    ->label('العنوان 1')
                    ->required(),
                Forms\Components\TextInput::make('address_2')
                    ->label('العنوان 2')
                    ->required(),
                Forms\Components\TextInput::make('ios_app_link')
                    ->label('رابط تطبيق iOS')
                    ->url(),
                Forms\Components\TextInput::make('android_app_link')
                    ->label('رابط تطبيق Android')
                    ->url(),
                Forms\Components\TextInput::make('x_link')
                    ->label('رابط X')
                    ->url()
                    ->required(),
                Forms\Components\TextInput::make('linkedin_link')
                    ->label('رابط LinkedIn')
                    ->url()
                    ->required(),
                Forms\Components\TextInput::make('youtube_link')
                    ->label('رابط YouTube')
                    ->url()
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
            'index' => Pages\ListInfoStaticContents::route('/'),
            'edit' => Pages\EditInfoStaticContent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return route(static::getRouteBaseName() . '.edit', 1);
    }

    public static function getModelLabel(): string
    {
        return __('static_content.info.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('static_content.info.model_label');
    }

    public static function getNavigationLabel(): string
    {

        return __('static_content.info.navigation_label');
    }
}
