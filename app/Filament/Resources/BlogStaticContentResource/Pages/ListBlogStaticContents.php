<?php

namespace App\Filament\Resources\BlogStaticContentResource\Pages;

use App\Filament\Resources\BlogStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlogStaticContents extends ListRecords
{
    protected static string $resource = BlogStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
