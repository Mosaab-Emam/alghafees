<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvaluationCompanyResource\Pages;
use App\Models\Evaluation\EvaluationCompany;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class EvaluationCompanyResource extends Resource
{
    protected static ?string $model = EvaluationCompany::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.EvaluationTransactions');
    }

    public static function getModelLabel(): string
    {
        return __('admin.EvaluationCompanies');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.EvaluationCompanies');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.EvaluationCompanies');
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('admin.Title'))
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('position')
                    ->label(__('admin.Position'))
                    ->numeric()
                    ->default(0)
                    ->required(),
                Forms\Components\Toggle::make('active')
                    ->label(__('admin.Publish'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.Title'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('position')
                    ->label(__('admin.Position'))
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('active')
                    ->label(__('admin.Publish'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.CreationDate'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('active')
                    ->label(__('admin.Publish')),
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
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['created_from'])
                            return null;

                        return 'Created from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                    }),
                Filter::make('created_until')
                    ->form([
                        DatePicker::make('created_until')
                            ->label(__('قبل تاريخ'))
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['created_until'])
                            return null;

                        return 'Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->authorize(can('evaluation-companies.edit')),
                Tables\Actions\DeleteAction::make()
                    ->authorize(can('evaluation-companies.delete'))
            ])
            ->bulkActions([
                ExportBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make()
                    ->authorize(can('evaluation-companies.delete')),
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
            'index' => Pages\ListEvaluationCompanies::route('/'),
            'create' => Pages\CreateEvaluationCompany::route('/create'),
            'edit' => Pages\EditEvaluationCompany::route('/{record}/edit'),
        ];
    }
}
