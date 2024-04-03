<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RateRequestResource\Pages;
use App\Helpers\Constants;
use App\Models\RateRequest;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DatePicker;
use Filament\Infolists\Components\Section;
use Filament\Tables\Filters\Filter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Illuminate\Contracts\Support\Htmlable;

class RateRequestResource extends Resource
{
    protected static ?string $model = RateRequest::class;


    public static function getModelLabel(): string
    {
        return __('admin.Rates');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.Rates');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.Rates');
    }

    public static function canCreate(): bool
    {
        return false;
    }
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->recent();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make(__('admin.rate-requests.client_info'))
                    ->schema([
                        TextEntry::make('name')
                            ->label(__('admin.rate-requests.name')),
                        TextEntry::make('email')
                            ->label(__('admin.rate-requests.email')),
                        TextEntry::make('mobile')
                            ->label(__('admin.rate-requests.mobile')),
                        TextEntry::make('request_no')
                            ->label(__('admin.rate-requests.request_no')),
                    ])
                    ->columns(2),
                Section::make(__('admin.rate-requests.asset_info'))
                    ->schema([
                        TextEntry::make('goal.title')
                            ->label(__('admin.rate-requests.goal')),
                        TextEntry::make('type.title')
                            ->label(__('admin.rate-requests.type')),
                        TextEntry::make('usage.title')
                            ->label(__('admin.rate-requests.usage')),
                        TextEntry::make('real_estate_age')
                            ->label(__('admin.rate-requests.real_estate_age')),
                        TextEntry::make('real_estate_area')
                            ->label(__('admin.rate-requests.real_estate_area')),
                    ])
                    ->columns(2),
                Section::make(__('admin.rate-requests.other_info'))
                    ->schema([
                        TextEntry::make('statusTitle')
                            ->label(__('admin.Status'))
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                __('admin.NewRequest') => 'info',
                                __('admin.NewWorkRequest') => 'info',
                                __('admin.InEvaluationRequest') => 'warning',
                                __('admin.CheckedRequest') => 'success',
                                __('admin.SuspendedRequest') => 'danger',
                            }),
                        TextEntry::make('notes')
                            ->label(__('admin.notes'))
                            ->columnSpanFull()
                    ])
                    ->columns(2),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('request_no')
                    ->label(__('admin.rate-requests.request_no'))
                    ->toggleable()
                    ->searchable()
                    ->tooltip(
                        fn (RateRequest $record): string =>
                        __('admin.notes') . (': ' . $record->notes ?? '')
                    )
                    ->icon('heroicon-o-eye'),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin.rate-requests.name'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('admin.rate-requests.email'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('mobile')
                    ->label(__('admin.rate-requests.mobile'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('goal.title')
                    ->label(__('admin.rate-requests.goal'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('type.title')
                    ->label(__('admin.rate-requests.type'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('entity.title')
                    ->label(__('admin.rate-requests.entity'))
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('real_estate_age')
                    ->label(__('admin.rate-requests.real_estate_age'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('real_estate_area')
                    ->label(__('admin.rate-requests.real_estate_area'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('usage.title')
                    ->label(__('admin.rate-requests.usage'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('statusTitle')
                    ->label(__('admin.rate-requests.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        __('admin.NewRequest') => 'info',
                        __('admin.NewWorkRequest') => 'info',
                        __('admin.InEvaluationRequest') => 'warning',
                        __('admin.CheckedRequest') => 'success',
                        __('admin.SuspendedRequest') => 'danger',
                    })
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.LastUpdate'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label(__('من تاريخ')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['created_from']) return null;
                        return 'Created from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                    }),
                Filter::make('created_until')
                    ->form([
                        DatePicker::make('created_until')
                            ->label(__('قبل تاريخ')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })->indicateUsing(function (array $data): ?string {
                        if (!$data['created_until']) return null;
                        return 'Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                    }),
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('admin.Status'))
                    ->options(array_map(fn ($item): string => __('admin.' . $item['title']), Constants::Statuses)),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->authorize(can('rates.show')),
                Tables\Actions\Action::make('update')
                    ->authorize(can('rates.edit'))
                    ->label(__('admin.Edit'))
                    ->icon('heroicon-m-pencil-square')
                    ->fillForm(fn (RateRequest $record): array => [
                        'notes' => $record->notes,
                        'status' => $record->status,
                    ])
                    ->form([
                        Forms\Components\Textarea::make('notes')
                            ->label(__('admin.notes'))
                            ->rows(6)
                            ->required()
                            ->columnSpanFull(),
                        Select::make('status')
                            ->label(__('admin.Status'))
                            ->options(array_map(fn ($item) => __('admin.' . $item['title']), Constants::Statuses))
                            ->visible(can('rates.changeStatus'))
                            ->required(),
                    ])
                    ->action(function (array $data, RateRequest $record): void {
                        $record->notes = $data['notes'];
                        $record->status = $data['status'];
                        $record->save();
                    })
                    ->modalHeading(__('admin.Edit'))
                    ->modalIcon('heroicon-o-link'),
                Tables\Actions\DeleteAction::make()
                    ->authorize(can('rates.delete')),
            ])
            ->bulkActions([
                ExportBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make()
                    ->authorize(can('rates.delete'))
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
            'index' => Pages\ListRateRequests::route('/'),
            'view' => Pages\ViewRateRequest::route('/{record}')
        ];
    }

    public static function getWidgets(): array
    {
        return [
            RateRequestResource\Widgets\RateRequestsStatusChart::class,
            RateRequestResource\Widgets\RateRequestsTypeChart::class,
            RateRequestResource\Widgets\RateRequestsPurposeChart::class,
            RateRequestResource\Widgets\RateRequestsEntityChart::class,
            RateRequestResource\Widgets\RateRequestsUsageChart::class,
        ];
    }
}
