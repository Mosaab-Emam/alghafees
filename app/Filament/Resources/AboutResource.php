<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Models\Content;
use App\Models\Scopes\ActiveScope;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

#[ScopedBy(ActiveScope::class)]
class AboutResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $slug = 'about';

    protected static ?int $navigationSort = 6;

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::withoutGlobalScope(ActiveScope::class)->about()->orderBy('position');
    }

    public static function getModelLabel(): string
    {
        if (str_starts_with(request()->route()->uri(), 'dashboard/shield/roles')) {
            return __('admin.About');
        }
        return __('admin.About');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.About');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.About');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.GeneralSettings');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Split::make([
                Infolists\Components\Section::make([
                    Infolists\Components\Grid::make(2)->schema([
                        Infolists\Components\TextEntry::make('title')
                            ->label(__('admin.Title')),
                        Infolists\Components\TextEntry::make('position')
                            ->label(__('admin.Position')),
                        Infolists\Components\IconEntry::make('active')
                            ->label(__('admin.Publish'))
                            ->boolean(),
                    ])
                ]),
                Infolists\Components\Section::make([
                    Infolists\Components\TextEntry::make('created_at')
                        ->label(__('admin.CreationDate'))
                        ->dateTime(),
                    Infolists\Components\TextEntry::make('updated_at')
                        ->label(__('admin.LastUpdate'))
                        ->dateTime(),
                ])->grow(false)
            ])->from('md')->columnSpanFull()
        ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('admin.Title'))
                    ->maxLength(255)
                    ->required(),
                Forms\Components\Toggle::make('active')
                    ->label(__('admin.Publish'))
                    ->required()
                    ->columnStart(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('position')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('admin.Title'))
                    ->toggleable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->label(__('admin.Publish'))
                    ->toggleable()
                    ->boolean(),

            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('active')
                    ->label(__('admin.Publish')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->successNotification(
                        function ($record) {
                            if (auth()->user()->hasRole('المدير العام')) return null;

                            $super_admins = \App\Models\User::role('المدير العام')->get();
                            return \Filament\Notifications\Notification::make()
                                ->title('تعديل عنصر في "عنا"')
                                ->body('المدير: ' . auth()->user()->name . ' قام بتعديل عنصر في "عنا"')
                                ->actions([
                                    \Filament\Notifications\Actions\Action::make('view')
                                        ->label(__('admin.ViewRecord'))
                                        ->url('/dashboard/about/' . $record->id)
                                ])
                                ->sendToDatabase($super_admins);
                        }
                    ),
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
            'index' => Pages\ListAbouts::route('/'),
            'view' => Pages\ViewAbout::route('/{record}'),
            'create' => Pages\CreateAbout::route('/create'),
            // 'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
