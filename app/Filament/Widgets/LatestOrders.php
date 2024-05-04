<?php

namespace App\Filament\Widgets;

use App\Helpers\Constants;
use App\Models\RateRequest;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\HtmlString;
use Tiptap\Nodes\Text;

class LatestOrders extends BaseWidget
{
    use \BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                RateRequest::recent()->take(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('request_no')->label('#'),
                Tables\Columns\TextColumn::make('clientSpan')
                    ->label(__('admin.Customer'))
                    ->html(),
                Tables\Columns\TextColumn::make('apartmentSpan')
                    ->label(__('admin.ApartmentDetail'))
                    ->html(),
                Tables\Columns\TextColumn::make('status')->label(__('admin.Status'))
                    ->state(function (RateRequest $record): string {
                        $statusId = $record->status;
                        $title = '';
                        foreach (Constants::Statuses as $status) {
                            if ($status['id'] == $statusId) {
                                $title = $status['title'];
                                break;
                            }
                        }
                        return $title !== '' ? __('admin.' . $title) : 'غير معلوم';
                    })
                    ->badge()->color(fn (string $state): string => match ($state) {
                        __('admin.NewRequest') => 'info',
                        __('admin.NewWorkRequest') => 'info',
                        __('admin.InEvaluationRequest') => 'warning',
                        __('admin.CheckedRequest') => 'success',
                        __('admin.SuspendedRequest') => 'danger',
                    }),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('admin.LastUpdate'))
                    ->dateTime(),
                /*Tables\Columns\TextColumn::make('notes')->label(__('admin.notes'))
                ->limit(50)*/

            ])
            ->actions([
                Tables\Actions\EditAction::make()->authorize(can('rates.edit')),
                Tables\Actions\DeleteAction::make()->authorize(can('rates.delete'))
            ])
            ->paginated(false)->heading(__('أحدث طلبات التقييم'));
    }
}
