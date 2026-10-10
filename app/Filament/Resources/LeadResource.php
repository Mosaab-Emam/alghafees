<?php

namespace App\Filament\Resources;

use App\Exports\LeadSpreadsheetExport;
use App\Filament\Resources\LeadResource\Pages;
use App\Models\Lead;
use App\Rules\LeadPhone;
use App\Support\LeadContactData;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class LeadResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Lead::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('leads.group');
    }

    public static function getModelLabel(): string
    {
        return __('leads.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('leads.plural');
    }

    public static function getPermissionPrefixes(): array
    {
        return ['view_any', 'view', 'create', 'update', 'delete', 'delete_any', 'import', 'export'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label(__('leads.name'))->required()->maxLength(255)
                ->mutateStateForValidationUsing(fn (?string $state) => LeadContactData::trim($state ?? '')),
            Forms\Components\Select::make('lead_category_id')
                ->label(__('leads.category'))
                ->relationship('category', 'name', fn (Builder $query) => $query->orderBy('name'))
                ->searchable()->preload()->exists('lead_categories', 'id'),
            Forms\Components\Repeater::make('phones')
                ->label(__('leads.phones'))
                ->simple(Forms\Components\TextInput::make('phone')
                    ->label(__('leads.phone'))->tel()->required()->maxLength(50)->rules([new LeadPhone]))
                ->defaultItems(0)->maxItems(20)->addActionLabel(__('leads.add_phone')),
            Forms\Components\Repeater::make('emails')
                ->label(__('leads.emails'))
                ->simple(Forms\Components\TextInput::make('email')
                    ->label(__('leads.email'))->email()->required()->maxLength(254)
                    ->mutateStateForValidationUsing(fn (?string $state) => LeadContactData::trim($state ?? '')))
                ->defaultItems(0)->maxItems(20)->addActionLabel(__('leads.add_email')),
            Forms\Components\Textarea::make('notes')
                ->label(__('leads.notes'))->rows(6)->maxLength(10000)->columnSpanFull(),
        ])->columns(2);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('category');
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('id', 'desc')->columns([
            Tables\Columns\TextColumn::make('name')->label(__('leads.name'))->searchable()->sortable(),
            Tables\Columns\TextColumn::make('category.name')->label(__('leads.category'))->badge()->sortable()->searchable(),
            Tables\Columns\TextColumn::make('phones')->label(__('leads.phones'))->listWithLineBreaks()->searchable(),
            Tables\Columns\TextColumn::make('emails')->label(__('leads.emails'))->listWithLineBreaks()->searchable(),
            Tables\Columns\TextColumn::make('notes')->label(__('leads.notes'))->limit(60)->searchable()->toggleable(),
            Tables\Columns\TextColumn::make('created_at')->label(__('leads.created_at'))->dateTime()->sortable()->toggleable(),
        ])->filters([
            Tables\Filters\SelectFilter::make('lead_category_id')->label(__('leads.category'))
                ->relationship('category', 'name')->searchable()->preload(),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\BulkAction::make('export')
                ->label(__('leads.export_selected'))->icon('heroicon-o-arrow-down-tray')
                ->visible(fn () => Gate::allows('export', Lead::class))
                ->action(function (Collection $records) {
                    Gate::authorize('export', Lead::class);

                    return Excel::download(LeadSpreadsheetExport::contacts($records->load('category')), 'contacts.xlsx');
                })->deselectRecordsAfterCompletion(),
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
        ];
    }
}
