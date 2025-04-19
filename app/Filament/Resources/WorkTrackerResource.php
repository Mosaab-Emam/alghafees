<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkTrackerResource\Pages;
use App\Filament\Resources\WorkTrackerResource\RelationManagers;
use App\Models\Evaluation\EvaluationEmployee;
use Illuminate\Database\Eloquent\Model;
use App\Models\WorkTracker;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkTrackerResource extends Resource
{
    protected static ?string $model = WorkTracker::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';


    public static function getModelLabel(): string
    {
        return __('admin.WorkTracker');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.WorkTrackers');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.WorkTrackers');
    }

    public static function getEloquentQuery(): Builder
    {
        return EvaluationEmployee::query()->has('workTrackers');
    }

    public static function canView(Model $record): bool
    {
        return auth()->user()->can('view_work::tracker');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.Employee'))
                    ->toggleable(),
                Tables\Columns\TextColumn::make('total_trackers_ended_today')
                    ->label('المنتهية اليوم')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('total_trackers_ended_this_month')
                    ->label('المنتهية هذا الشهر')
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\WorkTrackersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkTrackers::route('/'),
            'create' => Pages\CreateWorkTracker::route('/create'),
            'view' => Pages\ViewWorkTracker::route('/{record}'),
            'edit' => Pages\EditWorkTracker::route('/{record}/edit'),
        ];
    }
}