<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                Forms\Components\Grid::make(4)->schema([
                    Forms\Components\TextInput::make('name')
                        ->unique(fn (string $context) => $context === 'create')
                        ->label(__('admin.Name'))
                        ->maxLength(255)->required(),
                    Forms\Components\TextInput::make('email')->label(__('admin.E-mail'))
                        ->email()
                        ->unique(fn (string $context) => $context === 'create')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('mobile')->label(__('admin.Mobile'))
                        ->maxLength(255),
                    Forms\Components\Select::make('roles')->label(__('admin.Role'))
                        ->required()
                        ->relationship('roles','title', fn (Builder $query): Builder => $query->orderBy('id', 'asc'))
                ]),
                Forms\Components\TextInput::make('password')->label(__('admin.Password'))
                    ->password()
                    ->required(fn (string $context) => $context === 'create')
                    ->confirmed()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password_confirmation')->label(__('admin.PasswordConfirmation'))
                    ->password()
                    ->required(fn (string $context) => $context === 'create')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')->directory('images/admins')
                    ->label(__('admin.Image'))
                    ->image()->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->circular()->label(__('admin.Image')),
                Tables\Columns\TextColumn::make('name')->label(__('admin.Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')->label(__('admin.E-mail'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile')->label(__('admin.Mobile'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label(__('admin.CreationDate'))
                    ->dateTime()
                    ->sortable()
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')->label(__('من تاريخ')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            );

                    })->indicateUsing(function (array $data): ?string {
                        if (! $data['created_from']) {
                            return null;
                        }

                        return 'Created from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                    }),
                Filter::make('created_until')
                    ->form([
                        DatePicker::make('created_until')->label(__('قبل تاريخ')),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })->indicateUsing(function (array $data): ?string {
                        if (! $data['created_until']) {
                            return null;
                        }

                        return 'Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                    }),
                Tables\Filters\TernaryFilter::make('is_block')->label(__('مفعل')),
            ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make()->authorize(can('admins.edit')),
                Tables\Actions\DeleteAction::make()->authorize(function (User $record) {
                    return can('admins.delete') && $record->id !== 1;
                }),
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
