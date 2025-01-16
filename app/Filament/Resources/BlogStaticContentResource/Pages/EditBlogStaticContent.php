<?php

namespace App\Filament\Resources\BlogStaticContentResource\Pages;

use App\Filament\Resources\BlogStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlogStaticContent extends EditRecord
{
    protected static string $resource = BlogStaticContentResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
