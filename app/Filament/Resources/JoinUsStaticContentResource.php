<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JoinUsStaticContentResource\Pages;
use App\Filament\Resources\JoinUsStaticContentResource\RelationManagers;
use App\Models\JoinUsStaticContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JoinUsStaticContentResource extends Resource
{
    protected static ?string $model = JoinUsStaticContent::class;

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
            'index' => Pages\ListJoinUsStaticContents::route('/'),
            'create' => Pages\CreateJoinUsStaticContent::route('/create'),
            'edit' => Pages\EditJoinUsStaticContent::route('/{record}/edit'),
        ];
    }
}
