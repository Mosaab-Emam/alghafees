<?php

namespace App\Filament\Resources\ReviewResource\Pages;

use App\Filament\Resources\ReviewResource;
use App\Models\Review;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Str;

class ListReviews extends ListRecords
{
    protected static string $resource = ReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('create')
                ->label(__('resources/review.create'))
                ->action(function ($livewire) {
                    $review = Review::create([
                        'token' => Str::uuid(),
                        'name' => null,
                        'description' => null,
                        'rating' => null,
                        'body' => null
                    ]);

                    Notification::make()
                        ->title(__('resources/review.create_success'))
                        ->body(__('resources/review.create_success_body'))
                        ->success()
                        ->send();
                })
        ];
    }
}
