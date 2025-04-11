<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Evaluation\EvaluationEmployee;
use App\Models\WorkTracker;
use Filament\Tables;
use Filament\Forms;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Widgets\TableWidget as BaseWidget;

class WorkTrackers extends BaseWidget
{

    protected static ?int $sort = 0;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'تتبع العمل';

    public static function canView(): bool
    {
        return auth()->user()->can('view_any_work_tracker');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(WorkTracker::query())
            ->columns([
                Tables\Columns\TextColumn::make('employee.title')
                    ->label(__('admin.Employee')),
                Tables\Columns\TextColumn::make('type.title')
                    ->label(__('admin.type_id'))
                    ->badge(),
                Tables\Columns\TextColumn::make('number')
                    ->label(__('admin.transaction_number')),
                Tables\Columns\TextColumn::make('time_taken')
                    ->label('الوقت المستغرق')
                    ->badge(fn($record) => $record->timeTaken == null)
                    ->color(fn($record) => $record->timeTaken == null ? 'warning' : 'success')
                    ->default('لم يحسب بعد'),
                Tables\Columns\TextColumn::make('total_ended_today')
                    ->label('المنتهية اليوم'),
                Tables\Columns\TextColumn::make('total_ended_this_month')
                    ->label('المنتهية هذا الشهر'),
                Tables\Columns\TextColumn::make('notes')
                    ->label('الملاحظات')
            ])
            ->emptyStateHeading('لا توجد بيانات')
            ->emptyStateDescription(null)
            ->heading("تتبع العمل")
            ->headerActions([
                CreateAction::make()
                    ->model(WorkTracker::class)
                    ->visible(fn() => auth()->user()->can('create_work_tracker'))
                    ->label('إضافة تتبع')
                    ->modalHeading('إضافة تتبع')
                    ->createAnother(false)
                    ->form([
                        Forms\Components\Hidden::make('author_id')
                            ->label("أضيف بواسطة")
                            ->default(auth()->user()->id)
                            ->required(),
                        Forms\Components\Select::make('employee_id')
                            ->label(__('admin.Employee'))
                            ->options(EvaluationEmployee::pluck('title', 'id'))
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('type_id')
                            ->label(__('admin.type_id'))
                            ->options(Category::ApartmentType()->pluck('title', 'id'))
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('number')
                            ->required()
                            ->label(__('admin.transaction_number'))
                            ->maxLength(255),
                    ])
            ])
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make('end')
                    ->label('إنهاء')
                    ->visible(fn(WorkTracker $record) => !$record->ended_at && auth()->user()->can('update_work_tracker'))
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->modalHeading('إنهاء تتبع العمل')
                    ->modalSubmitActionLabel('إنهاء')
                    ->form([
                        Forms\Components\Textarea::make('notes')
                            ->label('الملاحظات')
                            ->rows(3),
                    ])
                    ->mutateFormDataUsing(function (array $data, WorkTracker $record) {
                        $data["ended_at"] = now();
                        return $data;
                    })
            ])
            ->bulkActions([
                // ...
            ]);
    }
}
