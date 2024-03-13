<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Helpers\Constants;
use App\Models\Category;
use App\Models\RateRequest;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';



    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return __('admin.Categories');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.Categories');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.Categories');
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
                    ->default(0),
                Forms\Components\Select::make('type')->label(__('admin.Categories'))
                    ->options(array_map(fn($item) => __('admin.'.$item) ,Constants::Categories))
                    ->required(),
                Forms\Components\Toggle::make('active')->label(__('admin.Publish'))
                    ->required()->columnStart(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label(__('admin.Title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')->label(__('admin.Position'))
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')->label(__('admin.Publish'))
                    ->boolean(),
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
                Tables\Filters\TernaryFilter::make('active')->label(__('admin.Publish')),
            ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\Action::make('update')->label(__('admin.Edit'))
                    ->icon('heroicon-m-pencil-square')
                    ->fillForm(fn (Category $record): array => [
                        'title' => $record->title,
                        'position' => $record->position,
                        'active' => $record->active
                    ])
                    ->form([
                        Forms\Components\TextInput::make('title')->label(__('admin.Title'))
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\TextInput::make('position')->label(__('admin.Position'))
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Forms\Components\Toggle::make('active')->label(__('admin.Publish'))
                            ->required()->columnStart(1)
                    ])
                    ->action(function (array $data, Category $record): void {
                        $data['slug'] = Str::slug($data['title'], '-');
                        $record->update($data);
                    })->modalHeading(__('admin.Edit'))->authorize(function (Category $record) {
                        $type = Constants::CategoriesPermissionsName[$record?->type];
                        return can( $type . ".edit");
                    })
                    ->modalIcon('heroicon-m-pencil-square'),
                Tables\Actions\DeleteAction::make()->authorize(function (Category $record) {
                    $type = Constants::CategoriesPermissionsName[$record?->type];
                    return can( $type . ".delete");
                })
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
           /* 'edit' => Pages\EditCategory::route('/{record}/edit'),*/
        ];
    }
}
