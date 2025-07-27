<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingApplicationResource\Pages;
use App\Filament\Resources\TrainingApplicationResource\RelationManagers;
use App\Models\TrainingApplication;
use App\Models\TrainingType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrainingApplicationResource extends Resource
{
    protected static ?string $model = TrainingApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 6;

    public static function getModelLabel(): string
    {
        return __('resources/training-application.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources/training-application.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('resources/training-application.plural');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
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
                Tables\Columns\TextColumn::make('training_type_id')
                    ->label('نوع التدريب')
                    ->formatStateUsing(fn($state) => TrainingType::find($state)->name)
                    ->searchable(),
                Tables\Columns\TextColumn::make('university_name')
                    ->label('اسم الجامعة')
                    ->searchable(),
                Tables\Columns\TextColumn::make('training_period')
                    ->label('مدة التدريب')
                    ->searchable(),
                Tables\Columns\TextColumn::make('starting_date')
                    ->label('تاريخ البدء')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->label('رقم الجوال')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->label('تحميل السيرة الذاتية')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function (TrainingApplication $record) {
                        return response()->download(public_path($record->cv_file));
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListTrainingApplications::route('/'),
        ];
    }
}
