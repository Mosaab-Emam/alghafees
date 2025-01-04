<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'الموقع';

    public static function getModelLabel(): string
    {
        return __('resources/event.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources/event.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('resources/event.plural');
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(2)
            ->schema([
                Infolists\Components\TextEntry::make('title')
                    ->label(__('resources/event.title')),
                Infolists\Components\TextEntry::make('date')
                    ->label(__('resources/event.date'))
                    ->date('Y-m-d'),
                Infolists\Components\TextEntry::make('location')
                    ->label(__('resources/event.location')),
                Infolists\Components\ImageEntry::make('images')
                    ->label(__('resources/event.images'))
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('resources/event.title'))
                    ->required(),
                Forms\Components\TextInput::make('description')
                    ->label(__('resources/event.description'))
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->label(__('resources/event.date'))
                    ->required()
                    ->native(false),
                Forms\Components\TextInput::make('location')
                    ->label(__('resources/event.location')),
                Forms\Components\FileUpload::make('images')
                    ->label(__('resources/event.images'))
                    ->directory('upload/events')
                    ->image()
                    ->multiple()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('images')
                    ->label(__('resources/event.images'))
                    ->sortable()
                    ->circular()
                    ->stacked()
                    ->limit(2)
                    ->limitedRemainingText(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('resources/event.title'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label(__('resources/event.date'))
                    ->date('Y-m-d')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label(__('resources/event.location'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'view' => Pages\ViewEvent::route('/{record}'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
