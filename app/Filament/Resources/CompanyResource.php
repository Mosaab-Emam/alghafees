<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use App\Models\Content;
use App\Models\ServiceCompany;
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
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class CompanyResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?int $navigationSort = 9;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->company();
    }

    public static function getModelLabel(): string
    {
        if (str_starts_with(request()->route()->uri(), 'dashboard/shield/roles')) {
            return __('admin.Companies');
        }
        return __('admin.Company');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.Companies');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.Companies');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(['default' => 2])
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('admin.Title'))
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label(__('admin.E-mail'))
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\TextInput::make('link')
                            ->label(__('admin.Link'))
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\TextInput::make('position')
                            ->label(__('admin.Position'))
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Forms\Components\FileUpload::make('image')
                            ->label(__('admin.Image'))
                            ->directory('images/companies')
                            ->image()->columnSpanFull(),

                        Forms\Components\Grid::make(['default' => 1, 'sm' => 2, 'lg' => 3])
                            ->schema([
                                Forms\Components\TextInput::make('mobile')
                                    ->label(__('admin.Mobile'))
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\TextInput::make('whats_app')
                                    ->label(__('admin.Whatsapp'))
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\Select::make('services')
                                    ->label(__('admin.CompanyServices'))
                                    ->options(Content::companyService()->get()->pluck('title', 'id'))
                                    ->multiple()
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                            ]),
                        Forms\Components\Textarea::make('description')
                            ->label(__('admin.Description'))
                            ->rows(6)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('active')
                            ->label(__('admin.Publish'))
                            ->required(),
                    ])
                    ->extraAttributes(['style' => 'background: transparent; box-shadow: none'])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#'),
                Tables\Columns\ImageColumn::make('image')
                    ->disk('public')
                    ->label(__('admin.Image'))
                    ->defaultImageUrl(url('/images/default.png'))
                    ->circular()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.Title'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('position')
                    ->label(__('admin.Position'))
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('active')
                    ->label(__('admin.Publish'))
                    ->boolean()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.CreationDate'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Filter::make('active')
                    ->label(__('admin.contents.active_filter'))
                    ->query(fn(Builder $query): Builder => $query->where('active', true)),
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
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
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
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (!$data['created_until'])
                            return null;

                        return 'Created until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()

            ])
            ->bulkActions([
                ExportBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
