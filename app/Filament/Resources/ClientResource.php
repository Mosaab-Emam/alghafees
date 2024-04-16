<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use App\Models\Content;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use WireUi\View\Components\Textarea;

class ClientResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 7;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->client();
    }

    public static function getModelLabel(): string
    {
        return __('admin.Clients');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.Clients');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.Clients');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->label(__('admin.Title'))
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('position')->label(__('admin.Position'))
                    ->numeric()
                    ->default(0)
                    ->required(),
                Forms\Components\FileUpload::make('image')->directory('images/clients')
                    ->label(__('admin.Image'))
                    ->image()->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->label(__('admin.Description'))->rows(6)
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('active')->label(__('admin.Publish'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('#'),
                Tables\Columns\ImageColumn::make('image')->label(__('admin.Image'))
                    ->defaultImageUrl(url('/images/default.png'))->circular(),
                Tables\Columns\TextColumn::make('title')->label(__('admin.Title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')->label(__('admin.Position'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')->label(__('admin.Publish'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')->label(__('admin.CreationDate'))
                    ->dateTime()
                    ->sortable()

            ])
            ->filters([
                Filter::make('active')
                    ->label(__('admin.clients.active_filter'))
                    ->query(fn (Builder $query): Builder => $query->where('active', true)),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label(__('من تاريخ'))
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            );
                    })->indicateUsing(function (array $data): ?string {
                        if (!$data['created_from']) {
                            return null;
                        }

                        return 'Created from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                    }),
                Filter::make('created_until')
                    ->form([
                        DatePicker::make('created_until')
                            ->label(__('قبل تاريخ'))
                            ->native(false),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })->indicateUsing(function (array $data): ?string {
                        if (!$data['created_until']) {
                            return null;
                        }

                        return 'Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->authorize(can('clients.edit')),
                Tables\Actions\DeleteAction::make()->authorize(can('clients.delete'))
            ])
            ->bulkActions([
                ExportBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make()->authorize(can('clients.delete')),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
