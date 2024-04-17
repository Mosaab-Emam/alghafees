<?php

namespace App\Livewire;

use App\Models\Evaluation\EvaluationEmployee;
use App\Models\Evaluation\EvaluationTransaction;
use App\Models\User;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Notifications\Notification;

class EmployeeSummary extends Component implements HasForms
{
    use InteractsWithForms;

    public $employee;
    public $record_id;
    public $type;
    public bool $disabled;
    public ?array $data = [];

    public function mount($employee, $record_id, $type, $disabled)
    {
        $this->employee = $employee == 'null' ? null : $employee;
        $this->record_id = $record_id;
        $this->type = $type;
        $this->disabled = $disabled;

        $this->form->fill();
    }


    public function form(Form $form): Form
    {
        $employee = $this->employee ? json_decode($this->employee) : null;
        $date_time = $this->employee ? json_decode($this->employee)->date_time : null;

        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('id')
                        ->label($this->getEmployeeSelectLabel())
                        ->options(EvaluationEmployee::all()->pluck('title', 'id'))
                        ->default($employee->id ?? null)
                        ->disabled($this->disabled)
                        ->searchable()
                        ->preload(),
                    Forms\Components\Checkbox::make('apply_employee')
                        ->label(__('actions.apply_employee'))
                        ->disabled($this->disabled),
                    Forms\Components\DateTimePicker::make('date_time')
                        ->label($this->getEmployeeDateTimeLabel())
                        ->native(false)
                        // ->default($date_time ?? null)
                        // ->disabled($this->disabled),
                        ->disabled(),
                ])
            ])->statePath('data');
    }

    private function getEmployeeSelectLabel()
    {
        if ($this->type == 'previewer') return __('admin.previewer');
        if ($this->type == 'income') return __('admin.income');
        if ($this->type == 'review') return __('admin.review');
    }

    private function getEmployeeDateTimeLabel()
    {
        if ($this->type == 'previewer') return __('admin.evaluation-transactions.forms.preview_datetime');
        if ($this->type == 'income') return __('admin.evaluation-transactions.forms.income_datetime');
        if ($this->type == 'review') return __('admin.evaluation-transactions.forms.review_datetime');
    }

    public function create(): void
    {
        $record = EvaluationTransaction::find($this->record_id);
        $apply_employee = $this->form->getState()['apply_employee'];

        if ($this->type == 'previewer') {
            $record->previewer_id = $this->form->getState()['id'];
            // $record->preview_date_time = $this->form->getState()['date_time'];

            if ($apply_employee) {
                $record->income_id = $this->form->getState()['id'];
                $record->review_id = $this->form->getState()['id'];
            }

            if ($this->form->getState()['id'] == null) {
                $record->income_id = null;
                $record->review_id = null;
            }

            if ($record->review_id != null)
                $record->status = 4;
            elseif ($record->previewer_id != null)
                $record->status = 3;
            else
                $record->status = 0;
        }

        if ($this->type == 'income') {
            $record->income_id = $this->form->getState()['id'];
            // $record->income_date_time = $this->form->getState()['date_time'];

            if ($apply_employee) {
                $record->previewer_id = $this->form->getState()['id'];
                $record->review_id = $this->form->getState()['id'];
            }

            if ($this->form->getState()['id'] == null)
                $record->review_id = null;

            if ($record->review_id != null)
                $record->status = 4;
            elseif ($record->previewer_id != null)
                $record->status = 3;
            else
                $record->status = 0;
        }

        if ($this->type == 'review') {
            $record->review_id = $this->form->getState()['id'];
            // $record->review_date_time = $this->form->getState()['date_time'];

            if ($apply_employee) {
                $record->previewer_id = $this->form->getState()['id'];
                $record->income_id = $this->form->getState()['id'];
            }

            if ($record->review_id != null) {
                $record->status = 4;

                $admin = User::find(1);
                Notification::make()
                    ->title('الرجاء إكمال معلومات المعاملة')
                    ->body('المعاملة بالرقم: ' . $record->transaction_number . ' تم إكمالها')
                    ->sendToDatabase($admin);
            } elseif ($record->previewer_id != null)
                $record->status = 3;
            else
                $record->status = 0;
        }

        $record->save();
        redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.employee-summary', ['employee' => json_decode($this->employee)]);
    }
}
