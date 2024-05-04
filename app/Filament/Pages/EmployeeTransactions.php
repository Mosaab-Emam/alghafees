<?php

namespace App\Filament\Pages;

use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class EmployeeTransactions extends Page implements HasTable
{
    use InteractsWithTable;
    use \BezhanSalleh\FilamentShield\Traits\HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static string $view = 'filament.pages.employee-transactions';

    protected static ?int $navigationSort = 4;

    protected static string | array $routeMiddleware  = 'checkPermission:evaluation-transactions.index';

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
    public function table(Table $table): Table
    {
        return $table
            ->query(\App\Models\Evaluation\EvaluationEmployee::query()->withCount('transactionpreviewer', 'transactionincome', 'transactionreview'))
            ->columns([
                TextColumn::make('title')
                    ->label(__('admin.Title'))
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('total')
                    ->label('إجمالى المعاملات')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('transactionpreviewer_count')
                    ->label(' المعاينات')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('transactionincome_count')
                    ->formatStateUsing(fn (string $state) => $state * .5)
                    ->label('الإدخال')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('transactionreview_count')
                    ->formatStateUsing(fn (string $state) => $state * .5)
                    ->label('المراجعة')
                    ->toggleable()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label(__('من تاريخ'))
                            ->native(false),
                    ])
                    ->baseQuery(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->withCount(['transactionpreviewer' => function ($q) use ($date) {
                                    $q->whereDate('created_at', '>=', $date);
                                }])->withCount(['transactionincome' => function ($q) use ($date) {
                                    $q->whereDate('created_at', '>=', $date);
                                }])->withCount(['transactionreview' => function ($q) use ($date) {
                                    $q->whereDate('created_at', '>=', $date);
                                }]),
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
                    ->baseQuery(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_until'],
                                function (Builder $query, $date): Builder {
                                    return $query->withCount(['transactionpreviewer' => function ($q) use ($date) {
                                        $q->whereDate('created_at', '<=', $date);
                                    }])->withCount(['transactionincome' => function ($q) use ($date) {
                                        $q->whereDate('created_at', '<=', $date);
                                    }])->withCount(['transactionreview' => function ($q) use ($date) {
                                        $q->whereDate('created_at', '<=', $date);
                                    }]);
                                },
                            );
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['created_until'])
                            return null;

                        return 'Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
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
