<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PricePackageResource\Pages;
use App\Filament\Resources\PricePackageResource\RelationManagers;
use App\Models\PricePackage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PricePackageResource extends Resource
{
    protected static ?string $model = PricePackage::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'الموقع (المحتوى المتغير)';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('icon')
                    ->label(__('resources/price_packages.icon'))
                    ->required()
                    ->image(),
                Forms\Components\TextInput::make('title')
                    ->columnStart(1)
                    ->label(__('resources/price_packages.title'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->label(__('resources/price_packages.price'))
                    ->numeric()
                    ->minValue(0)
                    ->suffix('ريال سعودي'),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label(__('resources/price_packages.description'))
                    ->maxLength(65535),
                Forms\Components\Repeater::make('perks')
                    ->label(__('resources/price_packages.perks'))
                    ->required()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('resources/price_packages.perk'))
                            ->required()
                            ->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('icon')
                    ->label(__('resources/price_packages.icon'))
                    ->toggleable(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('resources/price_packages.title'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('price')
                    ->label(__('resources/price_packages.price'))
                    ->money('SAR', 0)
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('resources/price_packages.created_at'))
                    ->dateTime('Y-m-d')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('resources/price_packages.updated_at'))
                    ->dateTime('Y-m-d')
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->hidden(fn() => PricePackage::count() <= 1)
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
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
            'index' => Pages\ListPricePackages::route('/'),
            'create' => Pages\CreatePricePackage::route('/create'),
            'edit' => Pages\EditPricePackage::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('resources/price_packages.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources/price_packages.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('resources/price_packages.plural');
    }
}
