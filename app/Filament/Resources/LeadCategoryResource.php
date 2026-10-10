<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadCategoryResource\Pages;
use App\Models\LeadCategory;
use App\Support\LeadContactData;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LeadCategoryResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = LeadCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('leads.group');
    }

    public static function getModelLabel(): string
    {
        return __('leads.category_singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('leads.categories');
    }

    public static function getPermissionPrefixes(): array
    {
        return ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'];
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label(__('leads.name'))
                ->required()->maxLength(255)->unique(ignoreRecord: true)
                ->mutateStateForValidationUsing(fn (?string $state) => LeadContactData::trim($state ?? '')),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('name')->columns([
            Tables\Columns\TextColumn::make('name')->label(__('leads.name'))->searchable()->sortable(),
            Tables\Columns\TextColumn::make('leads_count')->label(__('leads.contacts_count'))->counts('leads')->sortable(),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make()->modalDescription(__('leads.delete_category_help')),
        ])->bulkActions([
            Tables\Actions\DeleteBulkAction::make()->modalDescription(__('leads.delete_category_help')),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeadCategories::route('/'),
            'create' => Pages\CreateLeadCategory::route('/create'),
            'edit' => Pages\EditLeadCategory::route('/{record}/edit'),
        ];
    }
}
