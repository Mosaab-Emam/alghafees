<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Evaluation\EvaluationEmployee;
use App\Models\WorkTracker;
use Filament\Tables;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
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
            ->query(EvaluationEmployee::query()->where('has_visible_tracker', true))
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.Employee'))
                    ->toggleable(),
                Tables\Columns\TextColumn::make('closest_unended_work_tracker.type.title')
                    ->label(__('admin.type_id'))
                    ->badge(fn($record) => $record->closest_unended_work_tracker)
                    ->default('-')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('closest_unended_work_tracker.number')
                    ->label(__('admin.transaction_number'))
                    ->default('-')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('total_trackers_ended_today')
                    ->label('المنتهية اليوم')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('total_trackers_ended_this_month')
                    ->label('المنتهية هذا الشهر')
                    ->toggleable(),
            ])
            ->emptyStateHeading('لا توجد بيانات')
            ->emptyStateDescription(null)
            ->heading("تتبع العمل")
            ->headerActions([
                Action::make('select_visible_employees')
                    ->label('تحديد الموظفين المتتبعين')
                    ->icon('heroicon-o-user-group')
                    ->color('gray')
                    ->outlined()
                    ->modalSubmitActionLabel('تحديد الموظفين المتتبعين')
                    ->form([
                        Forms\Components\CheckboxList::make('visible_employees')
                            ->options(EvaluationEmployee::pluck('title', 'id'))
                            ->label('الموظفين المتتبعين')
                            ->columns(3)
                            ->default(
                                EvaluationEmployee::where('has_visible_tracker', true)
                                    ->pluck('id')
                                    ->map(fn($id) => (string) $id)
                                    ->toArray()
                            ),
                    ])
                    ->action(function (array $data) {
                        // First set all employees to false
                        EvaluationEmployee::query()->update(['has_visible_tracker' => false]);

                        // Then set selected employees to true
                        foreach ($data['visible_employees'] as $id) {
                            $employee = EvaluationEmployee::find($id);
                            $employee->has_visible_tracker = true;
                            $employee->save();
                        }

                        Notification::make()
                            ->success()
                            ->title('تم تحديد الموظفين المتتبعين بنجاح')
                            ->send();
                    }),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                CreateAction::make()
                    ->model(WorkTracker::class)
                    ->visible(
                        fn(EvaluationEmployee $record) =>
                        $record->closest_unended_work_tracker == null &&
                        auth()->user()->can('create_work_tracker')
                    )
                    ->label('تتبع')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('إضافة تتبع')
                    ->createAnother(false)
                    ->form(function ($record) {
                        return [
                            Forms\Components\Hidden::make('author_id')
                                ->default(auth()->user()->id)
                                ->required(),
                            Forms\Components\Hidden::make('employee_id')
                                ->default($record->id)
                                ->required(),
                            Forms\Components\Select::make('type_id')
                                ->label(__('admin.type_id'))
                                ->options(Category::ApartmentType()->pluck('title', 'id'))
                                ->searchable()
                                ->required(),
                            Forms\Components\TextInput::make('number')
                                ->label(__('admin.transaction_number'))
                                ->maxLength(255)
                                ->required(),
                        ];
                    }),
                EditAction::make('end')
                    ->label('إنهاء')
                    ->visible(
                        fn(EvaluationEmployee $record) =>
                        $record->closest_unended_work_tracker != null &&
                        auth()->user()->can('update_work_tracker')
                    )
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->modalHeading('إنهاء تتبع العمل')
                    ->modalSubmitActionLabel('إنهاء')
                    ->form([
                        Forms\Components\Textarea::make('notes')
                            ->label('الملاحظات')
                            ->rows(3),
                        Forms\Components\Textarea::make('wrongs')
                            ->label('المخالفات')
                            ->rows(3),
                    ])
                    ->mutateFormDataUsing(function (array $data) {
                        $data["ended_at"] = now();
                        return $data;
                    })
                    ->using(function (EvaluationEmployee $record, array $data): EvaluationEmployee {
                        $record->closest_unended_work_tracker->update($data);
                        return $record;
                    }),
            ])
            ->bulkActions([
                // ...
            ]);
    }
}
