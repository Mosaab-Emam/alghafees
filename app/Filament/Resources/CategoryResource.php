<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Helpers\Constants;
use App\Models\Category;
use App\Models\Scopes\ActiveScope;
use Filament\Infolists\Infolist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Filament\Infolists\Components;

#[ScopedBy([ActiveScope::class])]
class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        if (str_starts_with(request()->route()->uri(), 'dashboard/shield/roles')) {
            return __('admin.Categories');
        }
        return __('admin.Category');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.Categories');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.Categories');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('admin.GeneralSettings');
    }

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::withoutGlobalScope(ActiveScope::class)->orderBy('position');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('admin.Title'))
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('position')
                    ->label(__('admin.Position'))
                    ->numeric()
                    ->default(0),
                Forms\Components\Select::make('type')
                    ->label(__('admin.Categories'))
                    ->options(array_map(fn ($item) => __('admin.' . $item), Constants::Categories))
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Toggle::make('active')
                    ->label(__('admin.Publish'))
                    ->required()->columnStart(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('position')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.Title'))
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->label(__('admin.Publish'))
                    ->toggleable()
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('active')
                    ->label(__('admin.Publish')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('update')
                    ->label(__('admin.Edit'))
                    ->icon('heroicon-m-pencil-square')
                    ->fillForm(fn (Category $record): array => [
                        'title' => $record->title,
                        'active' => $record->active
                    ])
                    ->form([
                        Forms\Components\TextInput::make('title')
                            ->label(__('admin.Title'))
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\Toggle::make('active')
                            ->label(__('admin.Publish'))
                            ->required()
                    ])
                    ->action(function (array $data, Category $record): void {
                        $data['slug'] = Str::slug($data['title'], '-');
                        $record->update($data);
                    })
                    ->modalHeading(__('admin.Edit'))
                    ->modalIcon('heroicon-m-pencil-square'),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                ExportBulkAction::make()
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Grid::make(2)
                    ->schema([
                        Components\TextEntry::make('title')
                            ->label(__('admin.Title')),
                        Components\TextEntry::make('position')
                            ->label(__('admin.Position')),
                        Components\IconEntry::make('active')
                            ->label(__('admin.Publish'))
                            ->boolean(),
                        Components\TextEntry::make('created_at')
                            ->label(__('admin.CreationDate'))
                            ->dateTime()
                            ->columnStart(1),
                        Components\TextEntry::make('updated_at')
                            ->label(__('admin.LastUpdate'))
                            ->dateTime()
                    ])
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
            'index' => Pages\ListCategories::route('/'),
            'view' => Pages\ViewCategory::route('/{record}'),
            'create' => Pages\CreateCategory::route('/create'),
            /* 'edit' => Pages\EditCategory::route('/{record}/edit'),*/
        ];
    }
}
