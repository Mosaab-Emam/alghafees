<?php

namespace App\Filament\Pages;

use App\Helpers\Image;
use App\Interfaces\SettingRepositoryInterface;
use App\Models\Category;
use App\Models\Setting;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Forms\Components\Tabs;
use Filament\Tables\Columns\TextColumn;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Log;

class Settings extends Page implements HasForms
{

    use InteractsWithForms;
    use \BezhanSalleh\FilamentShield\Traits\HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.settings';

    protected static ?int $navigationSort = -1;

    public static function getNavigationLabel(): string
    {
        return __('admin.Settings');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.GeneralSettings');
    }

    public  function getTitle(): string
    {
        return __('admin.Settings');
    }

    protected ?string $heading = '';

    public ?array $data = [];

    public Setting $settings;

    private SettingRepositoryInterface $settingRepository;


    public function boot(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function mount()
    {
        $this->settings = $this->settingRepository->getFirstSettings();

        $this->form->fill($this->settings->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make(__('admin.About'))
                            ->schema([
                                TextInput::make('title')->label(__('admin.Title')),
                                TextInput::make('email')->label(__('admin.E-mail')),
                                TextInput::make('phone')->label(__('admin.Phone')),
                                TextInput::make('whats_app')->label(__('admin.Whatsapp'))
                            ])->columns(2),
                        Tabs\Tab::make(__('admin.Address'))
                            ->schema([
                                TextInput::make('address')->label(__('admin.Address')),
                            ]),
                        Tabs\Tab::make(__('admin.SocialLinks'))
                            ->schema([
                                TextInput::make('facebook')->label(__('admin.Facebook')),
                                TextInput::make('instagram')->label(__('admin.Instagram')),
                                TextInput::make('twitter')->label(__('admin.Twitter')),
                                TextInput::make('snapchat')->label(__('admin.snapchat')),
                                TextInput::make('linkedIn')->label(__('admin.linkedIn')),
                                TextInput::make('youTube')->label(__('admin.Youtube')),
                                TextInput::make('telegram')->label(__('admin.Telegram')),
                                TextInput::make('appStore')->label(__('admin.appStore')),
                                TextInput::make('googlePlay')->label(__('admin.googlePlay')),
                            ])->columns(),
                        Tabs\Tab::make(__('admin.Titles'))
                            ->schema([
                                TextInput::make('objective')->label(__('admin.Objective')),
                                TextInput::make('service')->label(__('admin.Service')),
                                TextInput::make('slider')->label(__('admin.Slider')),
                                RichEditor::make('about')->label(__('admin.About')),
                                TextInput::make('footer')->label(__('admin.FooterAbout')),
                            ]),
                        Tabs\Tab::make(__('admin.Uploads'))
                            ->schema([
                                FileUpload::make('about_image')
                                    ->image()
                                    ->directory('images/settings')
                                    ->label(__('admin.About')),
                                FileUpload::make('objective_image')
                                    ->image()
                                    ->directory('images/settings')
                                    ->label(__('admin.ObjectiveImage')),
                                FileUpload::make('slider_image')
                                    ->image()
                                    ->label(__('admin.SliderImage')),
                                FileUpload::make('page_background')
                                    ->image()
                                    ->directory('images/settings')
                                    ->label(__('admin.PageHeader')),
                                FileUpload::make('logo')
                                    ->image()
                                    ->directory('images/settings')
                                    ->label(__('admin.Logo')),
                                FileUpload::make('logo_white')
                                    ->image()
                                    ->directory('images/settings')
                                    ->label(__('admin.LogoWhite')),
                            ])->columns(2),
                    ])

            ])
            ->statePath('data')
            ->model($this->settings);
    }
    public function update()
    {

        $labels =   [
            'page_background',
            'logo',
            'logo_white',
            'slider_image',
            'objective_image',
            'about_image'
        ];

        foreach ($labels as $label) {
            $this->data[$label] = is_array($this->data[$label]) && $this->data[$label] !== [] ? reset($this->data[$label]) : $this->data[$label];

            $image = $this->data[$label];
            if ($image !== [] && $image instanceof TemporaryUploadedFile) {
                $this->data[$label] =    $image->store('images/settings', 'public');
            }
        }

        $this->settings->update($this->data);

        $super_admins = \App\Models\User::role('المدير العام')->get();
        if (!auth()->user()->hasRole('المدير العام'))
            \Filament\Notifications\Notification::make()
                ->title('تعديل إعدادات الموقع')
                ->body('المدير: ' . auth()->user()->name . ' قام بتعديل إعدادات الموقع')
                ->actions([
                    \Filament\Notifications\Actions\Action::make('view')
                        ->label(__('admin.ViewSettings'))
                        ->url('/dashboard/settings')
                ])
                ->sendToDatabase($super_admins);

        return redirect(Settings::getUrl());
    }
}
