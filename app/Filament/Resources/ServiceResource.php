<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
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

class ServiceResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->service();
    }

    public static function getModelLabel(): string
    {
        return __('admin.Service');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.Services');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.Services');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.GeneralSettings');
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
                Forms\Components\FileUpload::make('image')
                    ->directory('images/services')
                    ->label(__('admin.Image'))
                    ->image()->columnSpanFull(),
                Forms\Components\Textarea::make('description')->label(__('admin.Description'))
                    ->rows(8)->columnSpanFull(),
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
                    ->defaultImageUrl(url('/images/default.png'))->circular()
                ,
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
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')->label(__('من تاريخ')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            );

                    })->indicateUsing(function (array $data): ?string {
                        if (! $data['created_from']) {
                            return null;
                        }

                        return 'Created from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                    }),
                Filter::make('created_until')
                    ->form([
                        DatePicker::make('created_until')->label(__('قبل تاريخ')),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })->indicateUsing(function (array $data): ?string {
                        if (! $data['created_until']) {
                            return null;
                        }

                        return 'Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                    }),
                Tables\Filters\TernaryFilter::make('active')->label(__('admin.Publish')),
            ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make()->authorize(can('services.edit')),
                Tables\Actions\DeleteAction::make()->authorize(can('services.delete'))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->authorize(can('services.delete')),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
