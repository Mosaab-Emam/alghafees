<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvaluationTransactionResource\Pages;
use App\Helpers\Constants;
use App\Models\Category;
use App\Models\City;
use App\Models\Evaluation\EvaluationCompany;
use App\Models\Evaluation\EvaluationEmployee;
use App\Models\Evaluation\EvaluationTransaction;
use App\Models\Transaction_files;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class EvaluationTransactionResource extends Resource
{
    protected static ?string $model = EvaluationTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?int $navigationSort = 0;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.EvaluationTransactions');
    }

    public static function getModelLabel(): string
    {
        return __('admin.EvaluationTransaction');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.EvaluationTransactions');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.EvaluationTransaction');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->recent();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('id')->label(__('admin.TransactionDetail'))
                    ->getStateUsing(function (EvaluationTransaction $model) {
                        $output = '<strong>' . '#' . ':</strong> ' . $model->id . '<br/>';
                        $output .= '<strong>' . __('admin.CreationDate') . ':</strong> ' . Carbon::parse($model->created_at)->format('d/m/Y') . '<br/>';
                        $output .= '<strong>' . __('admin.instrument_number') . ':</strong> ' . $model->instrument_number . '<br/>';
                        $output .= '<strong>' . __('admin.transaction_number') . ':</strong> ' . $model->transaction_number . '<br/>';
                        $output .= '<strong>' . __('admin.Phone') . ':</strong> ' . $model->phone . '<br/>';
                        return $output;
                    })->html(),
                ViewEntry::make('details')->view('components.transaction_details', ['model' => $infolist->record]),
                TextEntry::make('previewer.title')->label(__('admin.previewer')),
                TextEntry::make('company.title')->label(__('admin.company')),
                TextEntry::make('company_fundoms')->label(__('admin.company_fundoms')),
                TextEntry::make('review_fundoms')->label(__('admin.review_fundoms'))->columnStart(1),
                TextEntry::make('notes')->label(__('admin.notes'))->columnSpanFull(),

                // TODO: uses a permission that does not exist yet
                // ViewEntry::make('files_t')->label(__('admin.files'))->columnSpanFull()
                //     ->view('filament.evaluation-transactions.show', [
                //         'files' => Transaction_files::where('transaction_id', $infolist->record->id)->get()
                //     ])

            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('resources/evaluation-transactions.id')),
                Tables\Columns\TextColumn::make('instrument_number')
                    ->label(__('resources/evaluation-transactions.instrument_number'))
                    ->searchable()
                    ->description(fn ($record) => $record->is_iterated ? __('resources/evaluation-transactions.repeated') : ''),
                Tables\Columns\TextColumn::make('transaction_number')
                    ->label(__('resources/evaluation-transactions.transaction_number'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->label(__('resources/evaluation-transactions.date'))
                    ->date()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('owner_name')
                    ->label(__('resources/evaluation-transactions.owner_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('resources/evaluation-transactions.phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('compatible_city')
                    ->label(__('resources/evaluation-transactions.city'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('compatible_plan_no')
                    ->label(__('resources/evaluation-transactions.plan_no'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('compatible_plot_no')
                    ->label(__('resources/evaluation-transactions.plot_no'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('type.title')
                    ->label(__('resources/evaluation-transactions.type'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('company.title')
                    ->label(__('resources/evaluation-transactions.company'))
                    ->sortable()
                    ->searchable()
                    ->default(__('resources/evaluation-transactions.unset')),
                Tables\Columns\TextColumn::make('city.title')
                    ->label(__('resources/evaluation-transactions.branch'))
                    ->sortable()
                    ->searchable()
                    ->default(__('resources/evaluation-transactions.unset'))
                    ->badge(fn ($record) => !$record->city_id)
                    ->color(fn ($record) => !$record->city_id ? 'danger' : ''),
                Tables\Columns\TextColumn::make('employee.title')
                    ->label(__('resources/evaluation-transactions.employee'))
                    ->sortable()
                    ->searchable()
                    ->default(__('resources/evaluation-transactions.unset')),
                Tables\Columns\TextColumn::make('review_fundoms')
                    ->label(__('resources/evaluation-transactions.reviewer_compensation'))
                    ->default(__('resources/evaluation-transactions.unset'))
                    ->suffix(fn ($record) => $record->review_fundoms ? 'ر.س' : '')
                    ->badge(fn ($record) => !$record->review_fundoms)
                    ->color(fn ($record) => !$record->review_fundoms ? 'danger' : ''),
                Tables\Columns\TextColumn::make('company_fundoms')
                    ->label(__('resources/evaluation-transactions.company_compensation'))
                    ->default(__('resources/evaluation-transactions.unset'))
                    ->suffix(fn ($record) => $record->company_fundoms ? 'ر.س' : '')
                    ->badge(fn ($record) => !$record->company_fundoms)
                    ->color(fn ($record) => !$record->company_fundoms ? 'danger' : ''),
                Tables\Columns\TextColumn::make('previewer.title')
                    ->label(__('resources/evaluation-transactions.previewer'))
                    ->default(__('resources/evaluation-transactions.unset'))
                    ->badge(fn ($record) => !$record->previewer_id)
                    ->color(fn ($record) => !$record->previewer_id ? 'danger' : ''),
                Tables\Columns\TextColumn::make('income.title')
                    ->label(__('resources/evaluation-transactions.entry_employee'))
                    ->default(__('resources/evaluation-transactions.unset'))
                    ->badge(fn ($record) => !$record->income_id)
                    ->color(fn ($record) => !$record->income_id ? 'danger' : ''),
                Tables\Columns\TextColumn::make('review.title')
                    ->label(__('resources/evaluation-transactions.reviewer'))
                    ->default(__('resources/evaluation-transactions.unset'))
                    ->badge(fn ($record) => !$record->review_id)
                    ->color(fn ($record) => !$record->review_id ? 'danger' : ''),
                Tables\Columns\TextColumn::make('statusWords')
                    ->label(__('resources/evaluation-transactions.status'))
                    ->icon('heroicon-m-pencil-square')
                    ->badge()
                    ->color(function (string $state) {
                        if ($state == __('admin.NewTransaction'))
                            return 'info';
                        if ($state == __('admin.ContactedRequest'))
                            return 'info';
                        if ($state == __('admin.InReviewRequest'))
                            return 'warning';
                        if ($state == __('admin.PendingRequest'))
                            return 'warning';
                        if ($state == __('admin.FinishedRequest'))
                            return 'success';
                        if ($state == __('admin.Cancelled'))
                            return 'danger';
                        if ($state == __('admin.ReviewedRequest'))
                            return 'danger';
                        return 'danger';
                    })
                    ->action(Tables\Actions\Action::make('update')
                        ->modalHidden(!can('evaluation-transactions.changeStatus'))
                        ->fillForm(fn (EvaluationTransaction $record): array => [
                            'status' => $record->status,
                        ])
                        ->form([
                            Forms\Components\Select::make('status')
                                ->label(__('admin.Status'))
                                ->options(array_map(fn ($item) => __('admin.' . $item['title']), Constants::TransactionStatuses))
                                ->required(),
                        ])
                        ->action(function (array $data, EvaluationTransaction $record): void {
                            $record->status = $data['status'];
                            $record->save();
                        })
                        ->modalHeading(__('admin.Edit'))
                        ->modalIcon('heroicon-o-link')),
                Tables\Columns\TextColumn::make('notes')
                    ->label(__('resources/evaluation-transactions.notes'))
                    ->default(__('resources/evaluation-transactions.unset'))
                    ->badge(fn ($record) => !$record->notes)
                    ->color(fn ($record) => !$record->notes ? 'danger' : ''),
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
                        if (!$data['created_from']) {
                            return null;
                        }

                        return 'Created from ' . \Carbon\Carbon::parse($data['created_from'])->toFormattedDateString();
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
                        if (!$data['created_until']) {
                            return null;
                        }

                        return 'Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                    }),
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('admin.Status'))
                    ->options(array_map(fn ($item): string => __('admin.' . $item['title']), Constants::TransactionStatuses)),
                Tables\Filters\SelectFilter::make('company')
                    ->label(__('admin.company'))
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->relationship('company', 'title'),
                Tables\Filters\SelectFilter::make('previewer')
                    ->label(__('admin.previewer'))
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->relationship('previewer', 'title', function (Builder $query) {
                        return $query->orderBy('id');
                    }),
                Tables\Filters\SelectFilter::make('review')
                    ->label(__('admin.review'))
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->relationship('review', 'title', function (Builder $query) {
                        return $query->orderBy('id');
                    }),
                Tables\Filters\SelectFilter::make('income')
                    ->label(__('admin.income'))
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->relationship('income', 'title', function (Builder $query) {
                        return $query->orderBy('id');
                    }),
                Tables\Filters\SelectFilter::make('city_id')
                    ->label(__('admin.city_id'))
                    ->options(Category::city()->pluck('title', 'id')),
            ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\ViewAction::make()->authorize(can('evaluation-transactions.show')),
                Tables\Actions\EditAction::make()->authorize(can('evaluation-transactions.edit')),
                Tables\Actions\DeleteAction::make()->authorize(can('evaluation-transactions.delete')),
            ])
            ->bulkActions([
                ExportBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make()
                    ->authorize(can('evaluation-transactions.delete'))
            ])
            ->filtersFormColumns(4);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('instrument_number')
                        ->label(__('admin.instrument_number'))
                        ->maxLength(255)
                        // TODO: Causes Table == '1'. Do it properly
                        // ->unique(fn (string $context) => $context !== 'edit')
                        ->required(),
                    Forms\Components\TextInput::make('transaction_number')
                        ->label(__('admin.transaction_number'))
                        ->maxLength(255)
                        // TODO: Causes Table == '1'. Do it properly
                        // ->unique(fn (string $context) => $context !== 'edit')
                        ->required(),
                    Forms\Components\TextInput::make('owner_name')
                        ->label(__('admin.owner_name'))
                        ->maxLength(255)->required(),
                    Forms\Components\Select::make('new_city_id')
                        ->label(__('admin.region'))
                        ->options(City::pluck('name_ar', 'id'))
                        ->required(),
                    Forms\Components\Select::make('city_id')
                        ->label(__('admin.city'))
                        ->options(Category::city()->pluck('title', 'id')),
                    Forms\Components\TextInput::make('plan_no')
                        ->label(__('admin.plan_no'))
                        ->maxLength(255)
                        ->required(),
                    Forms\Components\TextInput::make('plot_no')
                        ->label(__('admin.plot_no'))
                        ->maxLength(255)
                        ->required(),
                    Forms\Components\Select::make('type_id')
                        ->label(__('admin.type_id'))
                        ->options(Category::ApartmentType()->pluck('title', 'id'))
                        ->required(),
                    Forms\Components\Select::make('evaluation_company_id')
                        ->label(__('admin.evaluation_company_id'))
                        ->options(EvaluationCompany::pluck('title', 'id')),
                    Forms\Components\Select::make('evaluation_employee_id')
                        ->label(__('admin.evaluation_employee_id'))
                        ->options(EvaluationEmployee::pluck('title', 'id')),
                    Forms\Components\DatePicker::make('date')
                        ->label(__('admin.date'))
                        ->native(false)
                        ->required(),

                ])->columns(2),
                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('previewer_id')
                        ->label(__('admin.previewer'))
                        ->options(EvaluationEmployee::all()->pluck('title', 'id')),
                    Forms\Components\DateTimePicker::make('preview_date_time')
                        ->label(__('admin.evaluation-transactions.forms.preview_datetime'))
                        ->native(false),

                ])->columns(2),
                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('review_id')
                        ->label(__('admin.review'))
                        ->options(EvaluationEmployee::all()
                            ->pluck('title', 'id')),
                    Forms\Components\DateTimePicker::make('review_date_time')
                        ->label(__('admin.evaluation-transactions.forms.review_datetime'))
                        ->native(false),
                ])->columns(2),
                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('income_id')
                        ->label(__('admin.income'))
                        ->options(EvaluationEmployee::all()->pluck('title', 'id')),
                    Forms\Components\DateTimePicker::make('income_date_time')
                        ->label(__('admin.evaluation-transactions.forms.income_datetime'))
                        ->native(false),
                ])->columns(2),
                Forms\Components\Section::make()->schema([
                    Forms\Components\Textarea::make('notes')
                        ->label(__('admin.Notes'))
                        ->rows(6),
                    Forms\Components\TextInput::make('company_fundoms')
                        ->label(__('admin.company_fundoms'))
                        ->numeric(),
                    Forms\Components\TextInput::make('review_fundoms')
                        ->label(__('admin.review_fundoms'))
                        ->numeric(),
                    Forms\Components\TextInput::make('phone')
                        ->label(__('admin.Phone'))
                        ->tel()
                        ->required()
                        ->maxLength(20),

                ])->columns(2),
                Forms\Components\Section::make()->schema([
                    Forms\Components\FileUpload::make('files')
                        ->label(__('admin.files'))
                        ->columnSpanFull()
                        ->multiple()->storeFiles(false),
                    Forms\Components\Select::make('uploaded_files')
                        ->label(__('حذف الملفات'))
                        ->multiple()
                        ->visible(fn (string $context) => $context === 'edit')
                        ->options(Transaction_files::where('transaction_id', $form->getRecord()?->id)->pluck('path', 'id'))
                ])
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
            'index' => Pages\ListEvaluationTransactions::route('/'),
            'create' => Pages\CreateEvaluationTransaction::route('/create'),
            'edit' => Pages\EditEvaluationTransaction::route('/{record}/edit'),
            'view' => Pages\ViewEvaluationTransaction::route('/{record}'),
        ];
    }
}
