<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Evaluation\EvaluationEmployee;
use App\Models\WorkTracker;
use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class WorkTrackersWidget extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

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
            ])
            ->emptyStateHeading('لا توجد بيانات')
            ->emptyStateDescription(null)
            ->emptyStateActions([
                $this->getCreateAction()
            ])
            ->heading("تتبع العمل")
            ->headerActions([$this->getCreateAction()])
            ->filters([
                // ...
            ])
            ->actions([
                Action::make('end')
                    ->label('إنهاء')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (WorkTracker $record) {
                        $record->update([
                            'ended_at' => now()
                        ]);
                    })
                    ->visible(fn(WorkTracker $record) => !$record->ended_at)
            ])
            ->bulkActions([
                // ...
            ]);
    }

    protected function getCreateAction(): CreateAction
    {
        return CreateAction::make()
            ->model(WorkTracker::class)
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
            ]);
    }

    public function render(): View
    {
        return view('livewire.work-trackers-widget');
    }
}
