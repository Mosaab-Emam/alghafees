<?php

namespace App\Filament\Resources;

use App\Exports\GenericExport;
use App\Exports\RateRequestExport;
use App\Filament\Resources\EvaluationTransactionResource\Pages;
use App\Filament\Resources\EvaluationTransactionResource\RelationManagers;
use App\Helpers\Constants;
use App\Models\Category;
use App\Models\City;
use App\Models\Evaluation\EvaluationCompany;
use App\Models\Evaluation\EvaluationEmployee;
use App\Models\Evaluation\EvaluationTransaction;
use App\Models\RateRequest;
use App\Models\Transaction_files;
use Excel;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Filters\BaseFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Route;
use WireUi\View\Components\Select;

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
        return $table->recordAction(null)->recordUrl(null)
            ->columns([
                Tables\Columns\TextColumn::make('mainInfoSpan')->label(__('#'))
                    ->html()->searchable([
                        'id', 'instrument_number', 'transaction_number'
                    ]),
                Tables\Columns\TextColumn::make('detailsSpan')->label(__('admin.TransactionDetail'))
                    ->html()->searchable([
                        'owner_name',
                    ]),
                Tables\Columns\TextColumn::make('region_attribute')->label(__('admin.region'))->html(),
                Tables\Columns\TextColumn::make('company.title')->label(__('admin.company')),
                Tables\Columns\TextColumn::make('isiteratedName')->label(__('admin.is_iterated'))->default("لا")
                    ->badge()->color(fn (string $state): string => $state == __('admin.No') ? 'success' : 'danger'),
                Tables\Columns\TextColumn::make('statusWords')
                    ->label(__('admin.Status'))
                    ->icon('heroicon-m-pencil-square')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        __('admin.NewTransaction') => 'info',
                        __('admin.ContactedRequest') => 'info',
                        __('admin.InReviewRequest') => 'warning',
                        __('admin.PendingRequest') => 'warning',
                        __('admin.FinishedRequest') => 'success',
                        __('admin.Cancelled') => 'danger',
                        __('admin.ReviewedRequest') => 'danger',
                        'default' => 'danger'
                    })
                    ->action(Tables\Actions\Action::make('update')
                        ->modalHidden(!can('evaluation-transactions.changeStatus'))
                        ->fillForm(fn (EvaluationTransaction $record): array => [
                            'status' => $record->status,
                        ])
                        ->form([
                            \Filament\Forms\Components\Select::make('status')
                                ->label(__('admin.Status'))
                                ->options(array_map(fn ($item) => __('admin.' . $item['title']), Constants::TransactionStatuses))
                                ->required(),
                        ])
                        ->action(function (array $data, EvaluationTransaction $record): void {
                            $record->status = $data['status'];
                            $record->save();
                        })->modalHeading(__('admin.Edit'))->modalIcon('heroicon-o-link')),
            ])->filters([
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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('export_excel')->label(__('تصدير معاملات التقييم'))
                        ->icon('heroicon-m-arrow-down-tray')
                        ->action(function (\Illuminate\Support\Collection $records) {

                            $columns = [
                                trans('admin.notes'),
                                trans('admin.LastUpdate'),
                                trans('admin.is_iterated'),
                                trans('admin.Status'),
                                trans('admin.previewer'),
                                trans('admin.review_fundoms'),
                                trans('admin.company_fundoms'),
                                trans('admin.company'),
                                trans('admin.phone'),
                                trans('admin.transaction_number'),
                                trans('admin.instrument_number'),
                                '#',
                            ];

                            $fields = [
                                'notes',
                                'created_at',
                                'isiteratedName',
                                'statusWords',
                                'previewer.title',
                                'review_fundoms',
                                'company_fundoms',
                                'company.title',
                                'phone',
                                'transaction_number',
                                'instrument_number',
                                'id',
                            ];


                            $exports = new GenericExport($records, $columns, $fields);
                            $fileName = 'EvaluationTransactions_' . time() . '.xlsx';
                            return Excel::download($exports, $fileName);
                        }),
                    Tables\Actions\DeleteBulkAction::make()->authorize(can('evaluation-transactions.delete'))
                ]),
            ])->filtersFormColumns(4);
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
                        ->required(),

                ])->columns(2),
                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('previewer_id')
                        ->label(__('admin.previewer'))
                        ->options(EvaluationEmployee::all()->pluck('title', 'id')),
                    Forms\Components\DateTimePicker::make('preview_date_time')
                        ->label(__('admin.evaluation-transactions.forms.preview_datetime')),

                ])->columns(2),
                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('review_id')
                        ->label(__('admin.review'))
                        ->options(EvaluationEmployee::all()
                            ->pluck('title', 'id')),
                    Forms\Components\DateTimePicker::make('review_date_time')
                        ->label(__('admin.evaluation-transactions.forms.review_datetime')),
                ])->columns(2),
                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('income_id')
                        ->label(__('admin.income'))
                        ->options(EvaluationEmployee::all()->pluck('title', 'id')),
                    Forms\Components\DateTimePicker::make('income_date_time')
                        ->label(__('admin.evaluation-transactions.forms.income_datetime')),
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
