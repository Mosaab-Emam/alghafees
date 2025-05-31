<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationGroup = 'الموقع (المحتوى المتغير)';

    protected static ?int $navigationSort = 3;

    public static function getModelLabel(): string
    {
        return __('resources/review.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources/review.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('resources/review.plural');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(3)
            ->schema([
                Infolists\Components\TextEntry::make('name')
                    ->label(__('resources/review.name')),
                Infolists\Components\TextEntry::make('description')
                    ->label(__('resources/review.description')),
                Infolists\Components\TextEntry::make('rating')
                    ->label(__('resources/review.rating')),
                Infolists\Components\TextEntry::make('body')
                    ->label(__('resources/review.body'))
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('resources/review.image'))
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('resources/review.name'))
                    ->default('N/A'),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('resources/review.description'))
                    ->default('N/A'),
                Tables\Columns\TextColumn::make('rating')
                    ->label(__('resources/review.rating'))
                    ->default('N/A'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('copy_url')
                    ->visible(fn($record) => $record->name == null)
                    ->label(__('resources/review.copy_url'))
                    ->icon('heroicon-m-clipboard')
                    ->color('gray')
                    ->action(function ($livewire, $record): void {
                        $livewire->js(
                            'window.navigator.clipboard.writeText("' . config('app.url') . '/review/' . $record->token . '");
                $tooltip("' . __('resources/review.copy_url_success') . '", { timeout: 1500 });'
                        );
                    }),
                Tables\Actions\ViewAction::make()
                    ->visible(fn($record) => $record->is_filled),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'view' => Pages\ViewReview::route('/{record}'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
