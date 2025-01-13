<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FileResource\Pages;
use App\Filament\Resources\FileResource\RelationManagers;
use App\Models\File;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FileResource extends Resource
{
    protected static ?string $model = File::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'الموقع (المحتوى المتغير)';

    protected static ?int $navigationSort = 8;

    public static function getModelLabel(): string
    {
        return __('resources/file.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources/file.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('resources/file.plural');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(2)
            ->schema([
                Infolists\Components\TextEntry::make('title')
                    ->label(__('resources/file.title')),
                Infolists\Components\TextEntry::make('type')
                    ->label(__('resources/file.type'))
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('resources/file.title'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->label(__('resources/file.type'))
                    ->options([
                        'report' => __('resources/file.report'),
                        'evaluation' => __('resources/file.evaluation'),
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('file')
                    ->label(__('resources/file.file'))
                    ->required()
                    ->multiple(false)
                    ->directory('files'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('position')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('resources/file.title')),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('resources/file.type'))
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => __('resources/file.' . $state)),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download')
                    ->label(__('resources/file.download'))
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function (File $record) {
                        return response()->download(public_path($record->file));
                    }),
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
            'index' => Pages\ListFiles::route('/'),
            'create' => Pages\CreateFile::route('/create'),
            'view' => Pages\ViewFile::route('/{record}'),
            'edit' => Pages\EditFile::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderBy('position');
    }
}
