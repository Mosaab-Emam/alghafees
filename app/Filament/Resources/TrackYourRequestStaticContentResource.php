<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrackYourRequestStaticContentResource\Pages;
use App\Filament\Resources\TrackYourRequestStaticContentResource\RelationManagers;
use App\Models\TrackYourRequestStaticContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrackYourRequestStaticContentResource extends Resource
{
    protected static ?string $model = TrackYourRequestStaticContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListTrackYourRequestStaticContents::route('/'),
            'create' => Pages\CreateTrackYourRequestStaticContent::route('/create'),
            'edit' => Pages\EditTrackYourRequestStaticContent::route('/{record}/edit'),
        ];
    }
}
