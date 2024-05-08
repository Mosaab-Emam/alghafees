<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObjectiveResource\Pages;
use App\Models\Content;
use App\Models\Scopes\ActiveScope;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

#[ScopedBy(ActiveScope::class)]
class ObjectiveResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-fire';

    protected static ?int $navigationSort = 5;

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::withoutGlobalScope(ActiveScope::class)->objective()->orderBy('position');
    }

    public static function getModelLabel(): string
    {
        if (str_starts_with(request()->route()->uri(), 'dashboard/shield/roles')) {
            return __('admin.Objectives');
        }
        return __('admin.Objective');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.Objectives');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.Objectives');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.GeneralSettings');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Split::make([
                Infolists\Components\Section::make([
                    Infolists\Components\Grid::make(2)->schema([
                        Infolists\Components\TextEntry::make('title')
                            ->label(__('admin.Title')),
                        Infolists\Components\TextEntry::make('position')
                            ->label(__('admin.Position')),
                        Infolists\Components\IconEntry::make('active')
                            ->label(__('admin.Publish'))
                            ->boolean(),
                        Infolists\Components\TextEntry::make('description')
                            ->label(__('admin.Description'))
                            ->columnSpanFull(),
                    ])
                ]),
                Infolists\Components\Section::make([
                    Infolists\Components\ImageEntry::make('image')
                        ->label(false)
                        ->circular(),
                    Infolists\Components\TextEntry::make('created_at')
                        ->label(__('admin.CreationDate'))
                        ->dateTime(),
                    Infolists\Components\TextEntry::make('updated_at')
                        ->label(__('admin.LastUpdate'))
                        ->dateTime()
                ])->grow(false),
            ])->from('md')->columnSpanFull()
        ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->directory('images/objectives')
                    ->label(__('admin.Image'))
                    ->image()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('title')
                    ->label(__('admin.Title'))
                    ->maxLength(255)
                    ->required(),
                Forms\Components\Toggle::make('active')
                    ->label(__('admin.Publish'))
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label(__('admin.Description'))
                    ->rows(8)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('position')
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('admin.Image'))
                    ->toggleable()
                    ->defaultImageUrl(url('/images/default.png'))
                    ->circular(),
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                ExportBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListObjectives::route('/'),
            'view' => Pages\ViewObjective::route('/{record}'),
            'create' => Pages\CreateObjective::route('/create'),
            'edit' => Pages\EditObjective::route('/{record}/edit'),
        ];
    }
}
