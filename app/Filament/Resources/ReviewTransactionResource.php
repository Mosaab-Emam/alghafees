<?php

namespace App\Filament\Resources;

use App\Exports\GenericExport;
use App\Filament\Resources\EvaluationTransactionResource\Pages\CreateEvaluationTransaction;
use App\Filament\Resources\EvaluationTransactionResource\Pages\ListEvaluationTransactions;
use App\Filament\Resources\EvaluationTransactionResource\Pages\ListReviewTransactions;
use App\Filament\Resources\ReviewTransactionResource\RelationManagers;
use App\Helpers\Constants;
use App\Models\Category;
use App\Models\Evaluation\EvaluationTransaction;
use App\Models\Evaluation\EvaluationTransaction as Transaction;
use Excel;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class ReviewTransactionResource extends Resource
{
    protected static ?string $model = EvaluationTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return Transaction::Recent()->where('status',3);
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.EvaluationTransactions');
    }

    public static function getModelLabel(): string
    {
        return __('admin.reviewTransactions');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.reviewTransactions');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.reviewTransactions');
    }

    public static function table(Table $table): Table
    {
      $table = EvaluationTransactionResource::table($table);
      $table->actions([
          Tables\Actions\ViewAction::make()
              ->url(fn ($record) : string => EvaluationTransactionResource::getUrl('view',['record' => $record]))
              ->authorize(can('evaluation-transactions.show')),
          Tables\Actions\EditAction::make()
              ->url(fn ($record) : string => EvaluationTransactionResource::getUrl('edit',['record' => $record]))
              ->authorize(can('evaluation-transactions.edit')),
          Tables\Actions\DeleteAction::make()
              ->authorize(can('evaluation-transactions.delete'))
      ]);
      return $table;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReviewTransactions::route('/'),
         /*   'create' => CreateEvaluationTransaction::route('/create'),*/
       /*     'edit' => Pages\EditReviewTransaction::route('/{record}/edit'),*/
        ];
    }
}
