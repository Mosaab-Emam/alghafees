<?php

namespace App\Filament\Resources\WorkTrackerResource\RelationManagers;

use App\Models\WorkTracker;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkTrackersRelationManager extends RelationManager
{
    protected static string $relationship = 'workTrackers';

    protected static ?string $title = 'تتبع العمل';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ended_at')
            ->columns([
                Tables\Columns\TextColumn::make('type.title')
                    ->label(__('admin.Types')),
                Tables\Columns\TextColumn::make('number')
                    ->label(__('admin.transaction_number')),
                Tables\Columns\TextColumn::make('timeTaken')
                    ->label('الوقت المستغرق'),
                Tables\Columns\TextColumn::make('notes')
                    ->label('الملاحظات'),
                Tables\Columns\TextColumn::make('wrongs')
                    ->label('المخالفات'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('delete')
                    ->visible(auth()->user()->can('delete_work::tracker'))
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->label('حذف')
                    ->requiresConfirmation()
                    ->action(fn(WorkTracker $record) => $record->delete()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(
                            auth()->user()->can('delete_any_work::tracker')
                        ),
                ]),
            ]);
    }
}
