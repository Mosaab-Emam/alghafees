<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequestEvaluationStaticContentResource\Pages;
use App\Filament\Resources\RequestEvaluationStaticContentResource\RelationManagers;
use App\Models\RequestEvaluationStaticContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RequestEvaluationStaticContentResource extends Resource
{
    protected static ?string $model = RequestEvaluationStaticContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'الموقع (المحتوى الثابت)';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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
            'edit' => Pages\EditRequestEvaluationStaticContent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return route(static::getRouteBaseName() . '.edit', 1);
    }
}
