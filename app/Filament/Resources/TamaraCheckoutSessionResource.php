<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TamaraCheckoutSessionResource\Pages;
use App\Filament\Resources\TamaraCheckoutSessionResource\RelationManagers;
use App\Models\RateRequest;
use App\Models\TamaraCheckoutSession;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TamaraCheckoutSessionResource extends Resource
{
    protected static ?string $model = TamaraCheckoutSession::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('request_id')
                    ->label(__('admin.tamara.checkout_session.request_id'))
                    // ->options(dd(RateRequest::all()->pluck('id', 'id')))
                    ->options(function () {
                        $options = [];
                        $requests = RateRequest::tamaraSupported()->get();
                        foreach ($requests as $request) {
                            $options[$request->id] = $request->request_no . ' - ' . $request->full_name;
                        }
                        return $options;
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('rateRequest.request_no')
                    ->label(__('admin.tamara.checkout_session.rate_request_no'))
                    ->toggleable(),
                Tables\Columns\TextColumn::make('rateRequest.full_name')
                    ->label(__('admin.tamara.checkout_session.full_name'))
                    ->toggleable(),
                Tables\Columns\TextColumn::make('order_id')
                    ->label(__('admin.tamara.checkout_session.order_id'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('checkout_id')
                    ->label(__('admin.tamara.checkout_session.checkout_id'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status_ar')
                    ->label(__('admin.tamara.checkout_session.status'))
                    ->color(fn($record) => $record->status_color)
                    ->badge()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('copy_url')
                    ->visible(fn($record) => $record->status == 'new')
                    ->label(__('admin.tamara.checkout_session.copy_url'))
                    ->icon('heroicon-m-clipboard')
                    ->color('gray')
                    ->action(function ($livewire, $record): void {
                        $livewire->js(
                            'window.navigator.clipboard.writeText("' . $record->checkout_url . '");
                $tooltip("' . __('admin.tamara.checkout_session.copy_url_success') . '", { timeout: 1500 });'
                        );
                    }),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListTamaraCheckoutSessions::route('/'),
            'create' => Pages\CreateTamaraCheckoutSession::route('/create'),
            'edit' => Pages\EditTamaraCheckoutSession::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('admin.tamara.checkout_session.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.tamara.checkout_session.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.tamara.checkout_session.plural');
    }
}
