<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequestEvaluationStaticContentResource\Pages;
use App\Filament\Resources\RequestEvaluationStaticContentResource\RelationManagers;
use App\Models\RequestEvaluationStaticContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RequestEvaluationStaticContentResource extends Resource
{
    protected static ?string $model = RequestEvaluationStaticContent::class;

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
            'index' => Pages\ListRequestEvaluationStaticContents::route('/'),
            'create' => Pages\CreateRequestEvaluationStaticContent::route('/create'),
            'edit' => Pages\EditRequestEvaluationStaticContent::route('/{record}/edit'),
        ];
    }
}
