<?php

namespace App\Filament\Resources\LeadResource\Pages;

use App\Exceptions\LeadImportException;
use App\Exports\LeadSpreadsheetExport;
use App\Filament\Resources\LeadCategoryResource;
use App\Filament\Resources\LeadResource;
use App\Models\Lead;
use App\Services\LeadSpreadsheetImporter;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Locked;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class ListLeads extends ListRecords
{
    protected static string $resource = LeadResource::class;

    #[Locked]
    public array $importErrors = [];

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('categories')->label(__('leads.categories'))->color('gray')
                ->icon('heroicon-o-tag')->url(fn () => LeadCategoryResource::getUrl())
                ->visible(fn () => LeadCategoryResource::canViewAny()),
            Actions\Action::make('template')->label(__('leads.download_template'))->color('gray')
                ->icon('heroicon-o-document-arrow-down')
                ->visible(fn () => Gate::allows('import', Lead::class))
                ->action(function () {
                    Gate::authorize('import', Lead::class);

                    return Excel::download(LeadSpreadsheetExport::template(), 'contacts-template.xlsx');
                }),
            Actions\Action::make('export')->label(__('leads.export'))->icon('heroicon-o-arrow-down-tray')
                ->visible(fn () => Gate::allows('export', Lead::class))
                ->action(function () {
                    Gate::authorize('export', Lead::class);

                    return Excel::download(
                        LeadSpreadsheetExport::contacts($this->getFilteredTableQuery()->with('category')->get()),
                        'contacts.xlsx',
                    );
                }),
            Actions\Action::make('import')->label(__('leads.import'))->icon('heroicon-o-arrow-up-tray')
                ->visible(fn () => Gate::allows('import', Lead::class))
                ->modalWidth('5xl')->modalSubmitActionLabel(__('leads.validate_and_import'))
                ->mountUsing(function (\Filament\Forms\Form $form): void {
                    $this->importErrors = [];
                    $form->fill();
                })
                ->modalContent(fn () => view('filament.leads.import-help'))
                ->modalContentFooter(fn () => view('filament.leads.import-errors', ['errors' => $this->importErrors]))
                ->form([
                    FileUpload::make('file')->label(__('leads.file'))->required()
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'text/csv', 'text/plain', 'application/csv', 'application/vnd.ms-excel',
                        ])
                        ->rules(['extensions:xlsx,csv'])
                        ->validationMessages([
                            'required' => __('leads.file_required'),
                            'extensions' => __('leads.unsupported_file'),
                            'mimetypes' => __('leads.unsupported_file'),
                            'max' => __('leads.file_too_large'),
                        ])
                        ->maxSize(LeadSpreadsheetImporter::MAX_FILE_KB)->storeFiles(false)
                        ->afterStateUpdated(function (): void {
                            $this->importErrors = [];
                        }),
                    Select::make('delimiter')->label(__('leads.csv_delimiter'))->default('auto')->required()
                        ->options([
                            'auto' => __('leads.delimiter_auto'), 'comma' => __('leads.delimiter_comma'),
                            'semicolon' => __('leads.delimiter_semicolon'), 'tab' => __('leads.delimiter_tab'),
                        ])->in(['auto', 'comma', 'semicolon', 'tab'])->helperText(__('leads.delimiter_help')),
                ])
                ->extraModalFooterActions([
                    Actions\Action::make('downloadErrors')->label(__('leads.download_errors'))->color('danger')
                        ->visible(fn () => $this->importErrors !== [])
                        ->action(function () {
                            Gate::authorize('import', Lead::class);

                            return Excel::download(LeadSpreadsheetExport::errors($this->importErrors), 'contacts-import-errors.xlsx');
                        }),
                ])
                ->action(function (array $data, Actions\Action $action): void {
                    Gate::authorize('import', Lead::class);
                    $this->importErrors = [];
                    if (! ($data['file'] instanceof TemporaryUploadedFile)) {
                        $this->importErrors = [['row' => 1, 'column' => '', 'value' => '', 'message' => __('leads.unreadable_file')]];
                        $action->halt();
                    }

                    try {
                        $result = app(LeadSpreadsheetImporter::class)->import($data['file'], $data['delimiter']);
                    } catch (LeadImportException $exception) {
                        $this->importErrors = $exception->errors;
                        Notification::make()->title(__('leads.import_failed'))->body(__('leads.nothing_imported'))->danger()->send();
                        $action->halt();
                    } catch (Throwable $exception) {
                        report($exception);
                        $this->importErrors = [['row' => 1, 'column' => '', 'value' => '', 'message' => __('leads.save_failed')]];
                        Notification::make()->title(__('leads.import_failed'))->body(__('leads.nothing_imported'))->danger()->send();
                        $action->halt();
                    }

                    try {
                        $data['file']->delete();
                    } catch (Throwable $exception) {
                        // Cleanup failure must not make a successfully committed import look like a failure.
                        report($exception);
                    }
                    $this->resetTable();
                    Notification::make()->title(__('leads.import_success'))
                        ->body(__('leads.import_summary', $result))->success()->send();
                }),
            Actions\CreateAction::make(),
        ];
    }
}
