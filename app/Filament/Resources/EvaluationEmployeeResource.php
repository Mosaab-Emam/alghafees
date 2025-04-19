<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvaluationEmployeeResource\Pages;
use App\Models\Evaluation\EvaluationEmployee;
use App\Models\Scopes\ActiveScope;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class EvaluationEmployeeResource extends Resource
{
    protected static ?string $model = EvaluationEmployee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 6;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.EvaluationTransactions');
    }
    public static function getModelLabel(): string
    {
        if (str_starts_with(request()->route()->uri(), 'dashboard/shield/roles')) {
            return __('admin.EvaluationEmployees');
        }
        return __('admin.EvaluationEmployee');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.EvaluationEmployees');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.EvaluationEmployees');
    }

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::withoutGlobalScope(ActiveScope::class)->orderBy('position');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('title')
                    ->label(__('admin.Title')),
                Infolists\Components\TextEntry::make('price')
                    ->label(__('admin.Price'))
                    ->default('لم يحدد'),
                Infolists\Components\IconEntry::make('active')
                    ->label(__('admin.Publish'))
                    ->boolean(),
            ])
            ->columns(3);
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('admin.Title'))
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->label(__('admin.Price'))
                    ->numeric(),
                Forms\Components\Toggle::make('active')
                    ->label(__('admin.Publish'))
                    ->required()
                    ->columnStart(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('position')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.Title'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('active')
                    ->label(__('admin.Publish'))
                    ->boolean()
                    ->toggleable()
                    ->columnStart(1),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.CreationDate'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
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
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            );
                    })->indicateUsing(function (array $data): ?string {
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
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['created_until'])
                            return null;

                        return 'Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                    }),
                Tables\Filters\TernaryFilter::make('active')
                    ->label(__('admin.Publish')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()

            ])
            ->bulkActions([
                ExportBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListEvaluationEmployees::route('/'),
            'view' => Pages\ViewEvaluationEmployee::route('/{record}'),
            'create' => Pages\CreateEvaluationEmployee::route('/create'),
            'edit' => Pages\EditEvaluationEmployee::route('/{record}/edit'),
        ];
    }
}
