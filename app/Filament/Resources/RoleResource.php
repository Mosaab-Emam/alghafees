<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Permission\Permission;
use App\Models\Permission\Role;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Components\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';


    protected static ?int $navigationSort = 4;

    public static function getModelLabel(): string
    {
        return __('admin.Role');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.Role');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.Roles');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('title')->label(__('admin.Title'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('name')->label(__('admin.Name'))
                        ->required()
                        ->maxLength(255),
                ])->columns(),
                Forms\Components\Section::make()->schema([
                    Tabs::make('Tabs')->contained(false)
                        ->tabs(function () {
                            $mainPermissions = Permission::Parent()->get();
                            $tabs = [];
                            foreach ($mainPermissions as $mainPermission) {
                              $tabs[] = Tabs\Tab::make($mainPermission->title)
                                  ->icon('heroicon-o-cog-6-tooth')
                                  ->label(__('admin.'.$mainPermission->title))
                                            ->schema(function () use($mainPermission) {
                                        $radios = [];
                                        foreach ($mainPermission->children as $row ) {
                                            $radios[] = Forms\Components\CheckboxList::make('permissions')
                                                ->label(__('admin.'.$row->title))
                                                ->bulkToggleable()
                                                ->columns(6)
                                                ->columnSpanFull()
                                            ->options(function () use ($row,$mainPermission) {
                                                $options = [];
                                                $labels = ['List','Show','Create','Edit','Delete','ChangeStatus'];

                                                foreach ($mainPermission->permissions_types as $type) {
                                                    if (!empty($row->sub_permissions_arr[$type]))
                                                    $options[$row->sub_permissions_arr[$type]] = __('admin.'.$labels[$type]);
                                                }

                                                return  $options;
                                            });
                                        }

                                        return $radios;

                                    });

                            }

                            return $tabs;
                        })
                        ->columns(2)
                ])


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label(__('admin.Title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label(__('admin.CreationDate'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->authorize(can('roles.edit')),
                Tables\Actions\DeleteAction::make()->authorize(can('roles.delete')),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
