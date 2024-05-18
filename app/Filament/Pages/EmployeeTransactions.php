<?php

namespace App\Filament\Pages;

use App\Models\Evaluation\EvaluationEmployee;
use App\Models\Evaluation\EvaluationTransaction;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class EmployeeTransactions extends Page implements HasTable
{
    use InteractsWithTable;
    use \BezhanSalleh\FilamentShield\Traits\HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static string $view = 'filament.pages.employee-transactions';

    protected static ?int $navigationSort = 4;

    protected ?string $heading = '';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.EvaluationTransactions');
    }

    public static function getModelLabel(): string
    {
        return __('admin.user_transactions');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.user_transactions');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.user_transactions');
    }

    public function getTitle(): string|Htmlable
    {
        return __('admin.user_transactions');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(EvaluationEmployee::query())
            ->columns([
                TextColumn::make('title')
                    ->label(__('admin.Title'))
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('stats_total')
                    ->label('إجمالي المعاملات')
                    ->default(function ($record, $table) {
                        $transactions_from = $table->getFilters()['transactions_from']->getState()['transactions_from'];
                        $transactions_until = $table->getFilters()['transactions_until']->getState()['transactions_until'];
                        $query = EvaluationTransaction::query()
                            ->when($transactions_from, fn (Builder $query, $date): Builder => $query->whereDate('updated_at', '>=', $date))
                            ->when($transactions_until, fn (Builder $query, $date): Builder => $query->whereDate('updated_at', '<=', $date));
                        return $record->getQueryStats($query)['total'];
                    })
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('stats_previews')
                    ->label('المعاينات')
                    ->default(function ($record, $table) {
                        $transactions_from = $table->getFilters()['transactions_from']->getState()['transactions_from'];
                        $transactions_until = $table->getFilters()['transactions_until']->getState()['transactions_until'];
                        $query = EvaluationTransaction::query()
                            ->when($transactions_from, fn (Builder $query, $date): Builder => $query->whereDate('updated_at', '>=', $date))
                            ->when($transactions_until, fn (Builder $query, $date): Builder => $query->whereDate('updated_at', '<=', $date));
                        return $record->getQueryStats($query)['previews'];
                    })
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('stats_entries')
                    ->label('الإدخال')
                    ->default(function ($record, $table) {
                        $transactions_from = $table->getFilters()['transactions_from']->getState()['transactions_from'];
                        $transactions_until = $table->getFilters()['transactions_until']->getState()['transactions_until'];
                        $query = EvaluationTransaction::query()
                            ->when($transactions_from, fn (Builder $query, $date): Builder => $query->whereDate('updated_at', '>=', $date))
                            ->when($transactions_until, fn (Builder $query, $date): Builder => $query->whereDate('updated_at', '<=', $date));
                        return $record->getQueryStats($query)['entries'];
                    })
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('stats_reviews')
                    ->label('المراجعة')
                    ->default(function ($record, $table) {
                        $transactions_from = $table->getFilters()['transactions_from']->getState()['transactions_from'];
                        $transactions_until = $table->getFilters()['transactions_until']->getState()['transactions_until'];
                        $query = EvaluationTransaction::query()
                            ->when($transactions_from, fn (Builder $query, $date): Builder => $query->whereDate('updated_at', '>=', $date))
                            ->when($transactions_until, fn (Builder $query, $date): Builder => $query->whereDate('updated_at', '<=', $date));
                        return $record->getQueryStats($query)['reviews'];
                    })
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                Filter::make('transactions_from')
                    ->form([
                        DatePicker::make('transactions_from')
                            ->label(__('للمعاملات من تاريخ'))
                            ->native(false),
                    ])
                    ->baseQuery(fn (Builder $query): Builder => $query)
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['transactions_from'])
                            return null;

                        return 'للمعاملات من تاريخ ' . Carbon::parse($data['transactions_from'])->toDateString();
                    }),
                Filter::make('transactions_until')
                    ->form([
                        DatePicker::make('transactions_until')
                            ->label(__('للمعاملات حتى تاريخ'))
                            ->native(false),
                    ])
                    ->baseQuery(fn (Builder $query): Builder => $query)
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['transactions_until'])
                            return null;

                        return 'للمعاملات حتى تاريخ ' . Carbon::parse($data['transactions_until'])->toDateString();
                    }),
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                ExportBulkAction::make(),
            ]);
    }
}
