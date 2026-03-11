<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WhatsAppChatbotStringResource\Pages;
use App\Filament\Resources\WhatsAppChatbotStringResource\RelationManagers;
use App\Models\WhatsAppChatbotString;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WhatsAppChatbotStringResource extends Resource
{
    protected static ?string $model = WhatsAppChatbotString::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'الموقع (المحتوى الثابت)';

    protected static ?int $navigationSort = 20;

    protected static ?string $modelLabel = 'نص';

    protected static ?string $pluralModelLabel = 'نصوص بوت الواتساب';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->label('المفتاح')
                    ->required()
                    ->maxLength(255)
                    ->disabled(fn(?WhatsAppChatbotString $record) => $record !== null),
                Forms\Components\Textarea::make('value')
                    ->label('النص')
                    ->rows(4)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('description')
                    ->label('الوصف')
                    ->maxLength(255)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('المفتاح')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('value')
                    ->label('النص')
                    ->limit(60)
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('الوصف')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListWhatsAppChatbotStrings::route('/'),
            'create' => Pages\CreateWhatsAppChatbotString::route('/create'),
            'edit' => Pages\EditWhatsAppChatbotString::route('/{record}/edit'),
        ];
    }
}
