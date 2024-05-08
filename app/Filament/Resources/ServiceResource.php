<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Content;
use App\Models\Scopes\ActiveScope;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

#[ScopedBy(ActiveScope::class)]
class ServiceResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::withoutGlobalScope(ActiveScope::class)->service()->orderBy('position');
    }

    public static function getModelLabel(): string
    {
        if (str_starts_with(request()->route()->uri(), 'dashboard/shield/roles')) {
            return __('admin.Services');
        }
        return __('admin.Service');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.Services');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.Services');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.GeneralSettings');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Grid::make(2)->schema([
                Infolists\Components\ImageEntry::make('image')
                    ->label(__('admin.Image'))
                    ->circular()
                    ->columnSpanFull(),
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
                Infolists\Components\TextEntry::make('created_at')
                    ->label(__('admin.CreationDate'))
                    ->dateTime(),
                Infolists\Components\TextEntry::make('updated_at')
                    ->label(__('admin.LastUpdate'))
                    ->dateTime(),
            ])
        ]);
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
                    ->default(0)
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->directory('images/services')
                    ->label(__('admin.Image'))
                    ->image()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->label(__('admin.Description'))
                    ->rows(8)
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('active')
                    ->label(__('admin.Publish'))
                    ->required(),

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
            'index' => Pages\ListServices::route('/'),
            'view' => Pages\ViewService::route('/{record}'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
