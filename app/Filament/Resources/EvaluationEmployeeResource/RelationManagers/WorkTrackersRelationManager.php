<?php

namespace App\Filament\Resources\EvaluationEmployeeResource\RelationManagers;

use App\Filament\Resources\EvaluationEmployeeResource\Pages\ViewEvaluationEmployee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkTrackersRelationManager extends RelationManager
{
    protected static string $relationship = 'workTrackers';

    protected static ?string $title = 'تتبع العمل';

    public function isReadOnly(): bool
    {
        return true;
    }

    public static function canViewForRecord($ownerRecord, string $pageClass): bool
    {
        if ($ownerRecord->workTrackers->count() > 0) {
            return $pageClass === ViewEvaluationEmployee::class;
        }
        return false;
    }

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
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
