<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RentalResource\Pages;
use App\Models\Rental;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;

class RentalResource extends Resource
{
    protected static ?string $model = Rental::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return __('admin.rentals.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.rentals.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.rentals.plural');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.rentals.navigation_group');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('admin.rentals.sections.location_information'))
                    ->schema([
                        Map::make('location')
                            ->label(__('admin.rentals.fields.location'))
                            ->defaultLocation([24.7136, 46.6753]) // Riyadh, Saudi Arabia
                            ->clickable()
                            ->reactive()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make(__('admin.rentals.sections.rental_details'))
                    ->schema([
                        Forms\Components\DatePicker::make('contract_date')
                            ->label(__('admin.rentals.fields.contract_date'))
                            ->native(false)
                            ->required(),
                        Forms\Components\TextInput::make('area')
                            ->label(__('admin.rentals.fields.area'))
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('annual_rent')
                            ->label(__('admin.rentals.fields.annual_rent'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contract_number')
                            ->label(__('admin.rentals.fields.contract_number'))
                            ->required()
                            ->maxLength(255),
                        \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('attachments')
                            ->label(__('admin.rentals.fields.attachments'))
                            ->collection('attachments')
                            ->multiple()
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png', 'image/gif'])
                            ->maxSize(10240)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('contract_number')
                    ->label(__('admin.rentals.fields.contract_number'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('area')
                    ->label(__('admin.rentals.fields.area'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('annual_rent')
                    ->label(__('admin.rentals.fields.annual_rent'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('contract_date')
                    ->label(__('admin.rentals.fields.contract_date'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.rentals.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListRentals::route('/'),
            'create' => Pages\CreateRental::route('/create'),
            'view' => Pages\ViewRental::route('/{record}'),
            'edit' => Pages\EditRental::route('/{record}/edit'),
        ];
    }
}
