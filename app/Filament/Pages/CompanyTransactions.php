<?php

namespace App\Filament\Pages;


use App\Exports\GenericExport;
use App\Exports\RateRequestExport;
use App\Helpers\Constants;
use App\Models\Category;
use App\Models\City;
use Carbon\Carbon;
use Excel;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class CompanyTransactions extends Page  implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static string $view = 'filament.pages.company-transactions';

    protected static ?int $navigationSort = 3;

    protected static string | array $routeMiddleware = 'checkPermission:evaluation-transactions.index';

    protected ?string $heading = '';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.EvaluationTransactions');
    }

    public static function getModelLabel(): string
    {
        return __('admin.company_transactions');
    }

    public function getTitle(): string|Htmlable
    {
        return __('admin.company_transactions');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.company_transactions');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.company_transactions');
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(\App\Models\Evaluation\EvaluationCompany::query()->withCount('transaction')->with('transaction'))
            ->columns([
                TextColumn::make('title')->label(__('admin.Title'))->searchable(),
                TextColumn::make('transaction_count')
                    ->label('إجمالى المعاملات'),
            ])
            ->filters([
                Filter::make('all')
                    ->form([
                        DatePicker::make('created_from')
                            ->label(__('من تاريخ')),
                        DatePicker::make('created_until')
                            ->label(__('قبل تاريخ')),
                        Select::make('status')
                            ->label(__('admin.Status'))
                            ->options(array_map(fn ($item): string => __('admin.' . $item['title']), Constants::TransactionStatuses))
                            ->searchable()
                            ->preload(),
                        Select::make('city')
                            ->label(__('admin.city'))
                            ->options(Category::City()->pluck('title', 'id'))
                            ->searchable()
                            ->preload(),
                    ])->baseQuery(function (Builder $query, array $data): Builder {
                        return $query->withCount(['transaction' => function ($q) use ($data) {
                            if ($data['status'] >= 0 && $data['status'] !== null)
                                $q->where('status', $data['status']);
                            if ($data['city'] >= 0 && $data['city'] !== null)
                                $q->where('city_id', $data['city']);
                            if ($data['created_from'] !== null)
                                $q->whereDate('created_at', '>=', $data['created_from']);
                            if ($data['created_until'] !== null)
                                $q->whereDate('created_at', '<=', $data['created_until']);
                        }]);
                    })->columnSpanFull()->columns([
                        'default' => 2,
                        'md' => 4
                    ]),

            ], layout: FiltersLayout::AboveContent)
            ->actions([
                // ...
            ])
            ->bulkActions([
                BulkAction::make('export_excel')
                    ->label(__('تصدير اقفالات الشركات'))
                    ->icon('heroicon-m-arrow-down-tray')
                    ->action(function (\Illuminate\Support\Collection $records) {

                        $columns =  [
                            __('إجمالى المعاملات'),
                            __('admin.Title'),
                        ];

                        $fields = [
                            'transaction_count',
                            'title',
                        ];

                        $exports = new GenericExport($records, $columns, $fields);
                        $fileName = 'CompanyTransactions_' . time() . '.xlsx';
                        return Excel::download($exports, $fileName);
                    }),
            ]);
    }
}
