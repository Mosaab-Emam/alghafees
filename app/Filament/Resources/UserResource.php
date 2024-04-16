<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('admin.Admins');
    }
    public static function getModelLabel(): string
    {
        return __('admin.Users');
    }

    public static function getPluralLabel(): ?string
    {
        return __('admin.Users');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->unique(ignoreRecord: true)
                    ->label(__('admin.Name'))
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label(__('admin.E-mail'))
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mobile')
                    ->label(__('admin.Mobile'))
                    ->maxLength(255),
                Forms\Components\Select::make('roles')
                    ->label(__('admin.Role'))
                    ->required()
                    ->relationship('roles', 'title', fn (Builder $query): Builder => $query->orderBy('id', 'asc'))
                    ->searchable()
                    ->preload(),
                Forms\Components\Toggle::make('active')
                    ->label(__('admin.Publish'))
                    ->required()
                    ->columnStart(1),
                Forms\Components\TextInput::make('password')
                    ->label(__('admin.Password'))
                    ->password()
                    ->required(fn (string $context) => $context === 'create')
                    ->confirmed()
                    ->maxLength(255)
                    ->columnStart(1),
                Forms\Components\TextInput::make('password_confirmation')
                    ->label(__('admin.PasswordConfirmation'))
                    ->password()
                    ->required(fn (string $context) => $context === 'create')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->directory('images/admins')
                    ->label(__('admin.Image'))
                    ->image()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular()
                    ->toggleable()
                    ->label(__('admin.Image')),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('admin.Name'))
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('admin.E-mail'))
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile')
                    ->label(__('admin.Mobile'))
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.CreationDate'))
                    ->toggleable()
                    ->dateTime()
                    ->sortable()
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_block')
                    ->label(__('admin.users.block_filter')),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label(__('من تاريخ'))
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['created_from'])
                            return null;

                        return 'Created from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                    }),
                Filter::make('created_until')
                    ->form([
                        DatePicker::make('created_until')
                            ->label(__('قبل تاريخ'))
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['created_until'])
                            return null;

                        return 'Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->authorize(can('admins.edit')),
                Tables\Actions\DeleteAction::make()
                    ->authorize(function (User $record) {
                        return can('admins.delete') && $record->id !== 1;
                    }),
            ])
            ->bulkActions([
                ExportBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make()
                    ->authorize(can('clients.delete')),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
