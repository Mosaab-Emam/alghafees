<?php

namespace App\Filament\Pages;

use App\Models\Privacy;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;


class PrivacyPolicy extends Page implements HasForms
{
    use InteractsWithForms;
    use \BezhanSalleh\FilamentShield\Traits\HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static string $view = 'filament.pages.privacy-policy';

    protected static ?int $navigationSort = 8;

    public static function getNavigationLabel(): string
    {
        return __('admin.privacyPolicy');
    }


    public static function getNavigationGroup(): ?string
    {
        return __('admin.GeneralSettings');
    }

    protected ?string $heading = '';

    public ?array $data = [];


    public Privacy $privacy;


    public function mount(): void
    {
        $this->privacy = Privacy::first();
        $this->form->fill($this->privacy->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                RichEditor::make('privacy_ar')->label(__('admin.privacy_ar'))
                    ->required(),
                RichEditor::make('privacy_en')->label(__('admin.privacy_en'))
                    ->required(),
            ])->columns(2)
            ->statePath('data')
            ->model($this->privacy);
    }

    public function update(): void
    {

        if ($this->data['privacy_ar'] == ""  || $this->data['privacy_en'] == "") {
            Notification::make()
                ->title('Privacy cannot be empty ')
                ->danger()
                ->send();
        } else {
            $this->privacy->privacy_ar = $this->data['privacy_ar'];
            $this->privacy->privacy_en = $this->data['privacy_en'];
            $this->privacy->save();

            Notification::make()
                ->title('Updated successfully')
                ->success()
                ->send();
        }
    }
}
