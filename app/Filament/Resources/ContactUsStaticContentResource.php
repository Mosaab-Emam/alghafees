<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactUsStaticContentResource\Pages;
use App\Filament\Resources\ContactUsStaticContentResource\RelationManagers;
use App\Models\ContactUsStaticContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactUsStaticContentResource extends Resource
{
    protected static ?string $model = ContactUsStaticContent::class;

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
            'index' => Pages\ListContactUsStaticContents::route('/'),
            'create' => Pages\CreateContactUsStaticContent::route('/create'),
            'edit' => Pages\EditContactUsStaticContent::route('/{record}/edit'),
        ];
    }
}
