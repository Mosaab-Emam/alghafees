<?php

namespace App\Filament\Resources\AuctionResource\Pages;

use App\Filament\Resources\AuctionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreateAuction extends CreateRecord
{
    protected static string $resource = AuctionResource::class;

    protected function afterCreate(): void
    {
        // MediaLibrary files are handled automatically by SpatieMediaLibraryFileUpload component
    }
}
