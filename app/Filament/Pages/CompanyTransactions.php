<?php

namespace App\Filament\Pages;

use App\Helpers\Constants;
use App\Models\Category;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class CompanyTransactions extends Page  implements HasTable
{
    use InteractsWithTable;
    use \BezhanSalleh\FilamentShield\Traits\HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static string $view = 'filament.pages.company-transactions';

    protected static ?int $navigationSort = 3;

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
                TextColumn::make('title')
                    ->label(__('admin.Title'))
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('transaction_count')
                    ->label('إجمالى المعاملات')
                    ->toggleable()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('all')
                    ->form([
                        DatePicker::make('created_from')
                            ->label(__('من تاريخ'))
                            ->native(false),
                        DatePicker::make('created_until')
                            ->label(__('قبل تاريخ'))
                            ->native(false),
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
                    ])
                    ->baseQuery(function (Builder $query, array $data): Builder {
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
                    })
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                ExportBulkAction::make(),
            ]);
    }
}
