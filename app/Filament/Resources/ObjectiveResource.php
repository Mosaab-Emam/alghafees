<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObjectiveResource\Pages;
use App\Filament\Resources\ObjectiveResource\RelationManagers;
use App\Models\Content;
use App\Models\Objective;
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

class ObjectiveResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-fire';

    protected static ?int $navigationSort = 5;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->objective();
    }

    public static function getModelLabel(): string
    {
        if (str_starts_with(request()->route()->uri(), 'dashboard/shield/roles')) {
            return __('admin.Objectives');
        }
        return __('admin.Objective');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.Objectives');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.Objectives');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.GeneralSettings');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->label(__('admin.Title'))
                    ->maxLength(255)
                    ->required(),
                Forms\Components\TextInput::make('position')->label(__('admin.Position'))
                    ->numeric()
                    ->default(0)
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->directory('images/objectives')
                    ->label(__('admin.Image'))
                    ->image()->columnSpanFull(),

                Forms\Components\Textarea::make('description')->label(__('admin.Description'))
                    ->rows(8)->columnSpanFull(),
                Forms\Components\Toggle::make('active')->label(__('admin.Publish'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('#'),
                Tables\Columns\ImageColumn::make('image')->label(__('admin.Image'))
                    ->defaultImageUrl(url('/images/default.png'))->circular(),
                Tables\Columns\TextColumn::make('title')->label(__('admin.Title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')->label(__('admin.Position'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')->label(__('admin.Publish'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')->label(__('admin.CreationDate'))
                    ->dateTime()
                    ->sortable()

            ])
            ->filters([
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
                    })->indicateUsing(function (array $data): ?string {
                        if (!$data['created_from']) {
                            return null;
                        }

                        return 'Created from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                    }),
                Filter::make('created_until')
                    ->form([
                        DatePicker::make('created_until')
                            ->label(__('قبل تاريخ'))
                            ->native(false),
                    ])->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })->indicateUsing(function (array $data): ?string {
                        if (!$data['created_until']) {
                            return null;
                        }

                        return 'Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                    }),
                Tables\Filters\TernaryFilter::make('active')->label(__('admin.Publish')),
            ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListObjectives::route('/'),
            'create' => Pages\CreateObjective::route('/create'),
            'edit' => Pages\EditObjective::route('/{record}/edit'),
        ];
    }
}
