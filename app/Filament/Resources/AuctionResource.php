<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuctionResource\Pages;
use App\Models\Auction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;

class AuctionResource extends Resource
{
    protected static ?string $model = Auction::class;

    protected static ?string $navigationIcon = 'heroicon-o-scale';

    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return __('admin.auctions.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.auctions.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.auctions.plural');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.auctions.navigation_group');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('admin.auctions.sections.location_information'))
                    ->schema([
                        Map::make('location')
                            ->label(__('admin.auctions.fields.location'))
                            ->defaultLocation([24.7136, 46.6753]) // Riyadh, Saudi Arabia
                            ->clickable()
                            ->reactive()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make(__('admin.auctions.sections.auction_details'))
                    ->schema([
                        Forms\Components\TextInput::make('instrument_number')
                            ->label(__('admin.auctions.fields.instrument_number'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('area')
                            ->label(__('admin.auctions.fields.area'))
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('type')
                            ->label(__('admin.auctions.fields.type'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('opening_price')
                            ->label(__('admin.auctions.fields.opening_price'))
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->required(),
                        Forms\Components\DatePicker::make('date')
                            ->label(__('admin.auctions.fields.date'))
                            ->native(false)
                            ->required(),
                        Forms\Components\TextInput::make('highest_bid')
                            ->label(__('admin.auctions.fields.highest_bid'))
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make(__('admin.auctions.sections.additional_information'))
                    ->schema([
                        Forms\Components\Textarea::make('notes')
                            ->label(__('admin.auctions.fields.notes'))
                            ->nullable()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('auction_url')
                            ->label(__('admin.auctions.fields.auction_url'))
                            ->url()
                            ->nullable()
                            ->maxLength(255),
                        \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('attachments')
                            ->label(__('admin.auctions.fields.attachments'))
                            ->collection('attachments')
                            ->multiple()
                            ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png', 'image/gif'])
                            ->maxSize(10240)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('instrument_number')
                    ->label(__('admin.auctions.fields.instrument_number'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('area')
                    ->label(__('admin.auctions.fields.area'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('admin.auctions.fields.type'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('opening_price')
                    ->label(__('admin.auctions.fields.opening_price'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('highest_bid')
                    ->label(__('admin.auctions.fields.highest_bid'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label(__('admin.auctions.fields.date'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.auctions.fields.created_at'))
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
            'index' => Pages\ListAuctions::route('/'),
            'create' => Pages\CreateAuction::route('/create'),
            'view' => Pages\ViewAuction::route('/{record}'),
            'edit' => Pages\EditAuction::route('/{record}/edit'),
        ];
    }
}
