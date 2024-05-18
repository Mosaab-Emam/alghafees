<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvaluationTransactionResource\Pages;
use App\Models\Category;
use App\Models\City;
use App\Models\Evaluation\EvaluationCompany;
use App\Models\Evaluation\EvaluationEmployee;
use App\Models\Evaluation\EvaluationTransaction;
use App\Models\Transaction_files;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class EvaluationTransactionResource extends Resource
{
    protected static ?string $model = EvaluationTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?int $navigationSort = 0;

    public static function getNavigationGroup(): ?string
    {
        if (str_starts_with(request()->route()->uri(), 'dashboard/shield/roles')) {
            return __('admin.EvaluationTransactions');
        }
        return __('admin.EvaluationTransaction');
    }

    public static function getModelLabel(): string
    {
        return __('resources/evaluation-transaction.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources/evaluation-transaction.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('resources/evaluation-transaction.plural');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderBy('created_at', 'desc');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_iterated', true)->count();
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
            ->heading(function ($table) {
                $employee_id = $table->getFilters()['employee']->getState()['value'];
                if (!$employee_id) return null;
                return 'ملخص الموظف';
            })
            ->description(function (Table $table) {
                $employee_id = $table->getFilters()['employee']->getState()['value'];
                if (!$employee_id) return null;

                $employee = EvaluationEmployee::find($employee_id);
                $stats = $employee->getQueryStats($table->getLivewire()->getFilteredTableQuery());

                return "المعاملات: " . $stats['total'] . " المعاينات: " . $stats['previews'] . " الإدخال: " . $stats['entries'] . " المراجعة: " . $stats['reviews'];
            })
            ->columns([
                Tables\Columns\TextColumn::make('instrument_number')
                    ->label(__('resources/evaluation-transaction.instrument_number'))
                    ->searchable()
                    ->toggleable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->badge(fn ($record) => !$record->instrument_number)
                    ->color(fn ($record) => !$record->instrument_number ? 'danger' : ''),
                Tables\Columns\TextColumn::make('transaction_number')
                    ->label(__('resources/evaluation-transaction.transaction_number'))
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('owner_name')
                    ->label(__('resources/evaluation-transaction.owner_name'))
                    ->toggleable()
                    ->searchable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->badge(fn ($record) => !$record->owner_name)
                    ->color(fn ($record) => !$record->owner_name ? 'danger' : ''),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('resources/evaluation-transaction.phone'))
                    ->toggleable()
                    ->searchable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->badge(fn ($record) => !$record->phone)
                    ->color(fn ($record) => !$record->phone ? 'danger' : ''),
                Tables\Columns\TextColumn::make('compatible_city')
                    ->label(__('resources/evaluation-transaction.city'))
                    ->toggleable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->badge(fn ($record) => !$record->new_city_id && !$record->region)
                    ->color(fn ($record) => !$record->new_city_id && !$record->region ? 'danger' : ''),
                Tables\Columns\TextColumn::make('plan_no')
                    ->label(__('resources/evaluation-transaction.plan_no'))
                    ->toggleable()
                    ->searchable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->badge(fn ($record) => !$record->plan_no)
                    ->color(fn ($record) => !$record->plan_no ? 'danger' : ''),
                Tables\Columns\TextColumn::make('plot_no')
                    ->label(__('resources/evaluation-transaction.plot_no'))
                    ->toggleable()
                    ->searchable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->badge(fn ($record) => !$record->plot_no)
                    ->color(fn ($record) => !$record->plot_no ? 'danger' : ''),
                Tables\Columns\TextColumn::make('type.title')
                    ->label(__('resources/evaluation-transaction.type'))
                    ->toggleable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->badge(fn ($record) => !$record->type_id)
                    ->color(fn ($record) => !$record->type_id ? 'danger' : ''),
                Tables\Columns\TextColumn::make('company.title')
                    ->label(__('resources/evaluation-transaction.company'))
                    ->toggleable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->badge(fn ($record) => !$record->evaluation_company_id)
                    ->color(fn ($record) => !$record->evaluation_company_id ? 'danger' : ''),
                Tables\Columns\TextColumn::make('city.title')
                    ->label(__('resources/evaluation-transaction.branch'))
                    ->toggleable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->badge(fn ($record) => !$record->city_id)
                    ->color(fn ($record) => !$record->city_id ? 'danger' : ''),
                Tables\Columns\TextColumn::make('employee.title')
                    ->label(__('resources/evaluation-transaction.employee'))
                    ->toggleable()
                    ->sortable()
                    ->searchable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->badge(fn ($record) => !$record->employee)
                    ->color(fn ($record) => !$record->employee ? 'danger' : ''),
                Tables\Columns\TextColumn::make('review_fundoms')
                    ->label(__('resources/evaluation-transaction.reviewer_compensation'))
                    ->toggleable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->suffix(fn ($record) => $record->review_fundoms ? 'ر.س' : '')
                    ->badge(fn ($record) => !$record->review_fundoms)
                    ->color(fn ($record) => !$record->review_fundoms ? 'danger' : ''),
                Tables\Columns\TextColumn::make('company_fundoms')
                    ->label(__('resources/evaluation-transaction.company_compensation'))
                    ->toggleable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->suffix(fn ($record) => $record->company_fundoms ? 'ر.س' : '')
                    ->badge(fn ($record) => !$record->company_fundoms)
                    ->color(fn ($record) => !$record->company_fundoms ? 'danger' : ''),
                Tables\Columns\TextColumn::make('previewer.title')
                    ->label(__('resources/evaluation-transaction.previewer'))
                    ->toggleable()
                    ->sortable()
                    ->searchable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->badge(fn ($record) => !$record->previewer)
                    ->color(fn ($record) => !$record->previewer ? 'danger' : ''),
                Tables\Columns\TextColumn::make('income.title')
                    ->label(__('resources/evaluation-transaction.entry_employee'))
                    ->toggleable()
                    ->sortable()
                    ->searchable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->badge(fn ($record) => !$record->income)
                    ->color(fn ($record) => !$record->income ? 'danger' : ''),
                Tables\Columns\TextColumn::make('review.title')
                    ->label(__('resources/evaluation-transaction.reviewer'))
                    ->toggleable()
                    ->sortable()
                    ->searchable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->badge(fn ($record) => !$record->review)
                    ->color(fn ($record) => !$record->review ? 'danger' : ''),
                Tables\Columns\TextColumn::make('status_words')
                    ->label(__('resources/evaluation-transaction.status'))
                    ->toggleable()
                    ->sortable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->badge(fn ($record) => !$record->status)
                    ->color(fn ($record) => !$record->status ? 'danger' : ''),
                Tables\Columns\TextColumn::make('notes')
                    ->label(__('resources/evaluation-transaction.notes'))
                    ->toggleable()
                    ->default(__('resources/evaluation-transaction.unset'))
                    ->badge(fn ($record) => !$record->notes)
                    ->color(fn ($record) => !$record->notes ? 'danger' : ''),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.CreationDate'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.LastUpdate'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->recordClasses(function (Model $record) {
                if ($record->has_repeated_instrument_number)
                    return 'et-repeated-instrument-number-row';

                if ($record->has_repeated_address)
                    return 'et-repeated-address-row';
            })
            ->filters([
                Tables\Filters\TernaryFilter::make('is_iterated')
                    ->label(__('resources/evaluation-transaction.repeated')),
                Filter::make('from')
                    ->form([
                        DatePicker::make('from')
                            ->label(__('من تاريخ'))
                            ->native(false),
                    ])
                    ->query(
                        fn (Builder $query, array $data): Builder => $query
                            ->when($data['from'], fn (Builder $query, $date): Builder => $query->whereDate('updated_at', '>=', $date))
                    )
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['from']) return null;
                        return __('resources/evaluation-transaction.from') . ' ' . \Carbon\Carbon::parse($data['from'])->toDateString();
                    }),
                Filter::make('to')
                    ->form([
                        DatePicker::make('to')
                            ->label(__('إلى تاريخ'))
                            ->native(false),
                    ])
                    ->query(
                        fn (Builder $query, array $data): Builder => $query
                            ->when($data['to'], fn (Builder $query, $date): Builder => $query->whereDate('updated_at', '<=', $date))
                    )
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['to']) return null;
                        return __('resources/evaluation-transaction.to') . ' ' . \Carbon\Carbon::parse($data['to'])->toDateString();
                    }),
                Tables\Filters\SelectFilter::make('company')
                    ->label(__('admin.company'))
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->relationship('company', 'title'),
                Tables\Filters\SelectFilter::make('employee')
                    ->label(__('admin.Employee'))
                    ->options(EvaluationEmployee::pluck('title', 'id'))
                    ->searchable()
                    ->preload()
                    ->query(function (Builder $query, array $data): Builder {
                        if (!$data['value']) return $query;
                        return $query
                            ->where(function ($q) use ($data) {
                                $q->where('previewer_id', $data['value'])
                                    ->orWhere('income_id', $data['value'])
                                    ->orWhere('review_id', $data['value']);
                            });
                    }),
                Tables\Filters\SelectFilter::make('city_id')
                    ->label(__('admin.city_id'))
                    ->options(Category::city()->pluck('title', 'id'))
                    ->searchable()
                    ->preload()
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make()

            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('instrument_number')
                            ->label(__('admin.instrument_number'))
                            ->maxLength(255)
                            ->reactive()
                            ->suffix(function (callable $get) {
                                $instrument_number = $get('instrument_number');
                                $exists = EvaluationTransaction::where('instrument_number', $instrument_number)->exists();
                                if ($exists)
                                    return "مكرر";
                            }),
                        Forms\Components\TextInput::make('transaction_number')
                            ->label(__('admin.transaction_number'))
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\TextInput::make('owner_name')
                            ->label(__('admin.owner_name'))
                            ->maxLength(255),
                        Forms\Components\Select::make('new_city_id')
                            ->label(__('admin.region'))
                            ->options(City::pluck('name_ar', 'id'))
                            ->reactive()
                            ->searchable()
                            ->preload()
                            ->suffix(function (callable $get) {
                                $instrument_number = $get('instrument_number');
                                $new_city_id = $get('new_city_id');
                                $plan_no = $get('plan_no');
                                $plot_no = $get('plot_no');

                                if (
                                    $new_city_id == null ||
                                    $plan_no == null ||
                                    $plot_no == null
                                ) return "";

                                $exists = EvaluationTransaction::where('instrument_number', $instrument_number)
                                    ->where('new_city_id', $new_city_id)
                                    ->where('plan_no', $plan_no)
                                    ->where('plot_no', $plot_no)
                                    ->exists();

                                if ($exists)
                                    return "مكرر";
                            }),
                        Forms\Components\TextInput::make('plan_no')
                            ->label(__('admin.plan_no'))
                            ->maxLength(255)
                            ->reactive()
                            ->suffix(function (callable $get) {
                                $new_city_id = $get('new_city_id');
                                $plan_no = $get('plan_no');
                                $plot_no = $get('plot_no');

                                if (
                                    $new_city_id == null ||
                                    $plan_no == null ||
                                    $plot_no == null
                                ) return "";

                                $exists = EvaluationTransaction::where('new_city_id', $new_city_id)
                                    ->where('plan_no', $plan_no)
                                    ->where('plot_no', $plot_no)
                                    ->exists();

                                if ($exists)
                                    return "مكرر";
                            }),
                        Forms\Components\TextInput::make('plot_no')
                            ->label(__('admin.plot_no'))
                            ->maxLength(255)
                            ->reactive()
                            ->suffix(function (callable $get) {
                                $new_city_id = $get('new_city_id');
                                $plan_no = $get('plan_no');
                                $plot_no = $get('plot_no');

                                if (
                                    $new_city_id == null ||
                                    $plan_no == null ||
                                    $plot_no == null
                                ) return "";

                                $exists = EvaluationTransaction::where('new_city_id', $new_city_id)
                                    ->where('plan_no', $plan_no)
                                    ->where('plot_no', $plot_no)
                                    ->exists();

                                if ($exists)
                                    return "مكرر";
                            }),
                        Forms\Components\Select::make('type_id')
                            ->label(__('admin.type_id'))
                            ->options(Category::ApartmentType()->pluck('title', 'id'))
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('evaluation_company_id')
                            ->label(__('admin.evaluation_company_id'))
                            ->options(EvaluationCompany::pluck('title', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('city_id')
                            ->label(__('admin.city'))
                            ->options(Category::city()->pluck('title', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('evaluation_employee_id')
                            ->label(__('admin.evaluation_employee_id'))
                            ->options(EvaluationEmployee::pluck('title', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])->columns(2),
                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('previewer_id')
                        ->label(__('admin.previewer'))
                        ->options(EvaluationEmployee::all()->pluck('title', 'id'))
                        ->searchable()
                        ->preload()
                        ->hintAction(
                            Action::make('apply_employee')
                                ->label(__('actions.apply_employee'))
                                ->icon('heroicon-o-check')
                                ->action(function (Set $set, $state) {
                                    $set('previewer_id', $state);
                                    $set('income_id', $state);
                                    $set('review_id', $state);
                                })
                        ),
                    Forms\Components\DateTimePicker::make('preview_date_time')
                        ->label(__('admin.evaluation-transactions.forms.preview_datetime'))
                        ->native(false)
                        ->disabled(),

                ])->columns(2),
                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('income_id')
                        ->label(__('admin.income'))
                        ->options(EvaluationEmployee::all()->pluck('title', 'id'))
                        ->searchable()
                        ->preload()
                        ->hintAction(
                            Action::make('apply_employee')
                                ->label(__('actions.apply_employee'))
                                ->icon('heroicon-o-check')
                                ->action(function (Set $set, $state) {
                                    $set('previewer_id', $state);
                                    $set('income_id', $state);
                                    $set('review_id', $state);
                                })
                        ),
                    Forms\Components\DateTimePicker::make('income_date_time')
                        ->label(__('admin.evaluation-transactions.forms.income_datetime'))
                        ->native(false)
                        ->disabled(),
                ])->columns(2),
                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('review_id')
                        ->label(__('admin.review'))
                        ->options(EvaluationEmployee::all()->pluck('title', 'id'))
                        ->searchable()
                        ->preload()
                        ->hintAction(
                            Action::make('apply_employee')
                                ->label(__('actions.apply_employee'))
                                ->icon('heroicon-o-check')
                                ->action(function (Set $set, $state) {
                                    $set('previewer_id', $state);
                                    $set('income_id', $state);
                                    $set('review_id', $state);
                                })
                        ),
                    Forms\Components\DateTimePicker::make('review_date_time')
                        ->label(__('admin.evaluation-transactions.forms.review_datetime'))
                        ->native(false)
                        ->disabled(),
                ])->columns(2),
                Forms\Components\Section::make()->schema([
                    Forms\Components\Textarea::make('notes')
                        ->label(__('admin.Notes'))
                        ->rows(6)
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('company_fundoms')
                        ->label(__('admin.company_fundoms'))
                        ->numeric(),
                    Forms\Components\TextInput::make('review_fundoms')
                        ->label(__('admin.review_fundoms'))
                        ->numeric(),
                    Forms\Components\TextInput::make('phone')
                        ->label(__('admin.Phone'))
                        ->tel()
                        ->maxLength(20),
                ])->columns(2),
                Forms\Components\Section::make()->schema([
                    Forms\Components\FileUpload::make('files')
                        ->label(__('admin.files'))
                        ->columnSpanFull()
                        ->multiple()
                        ->storeFiles(false),
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
