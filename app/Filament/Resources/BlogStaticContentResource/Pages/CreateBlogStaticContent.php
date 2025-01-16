<?php

namespace App\Filament\Resources\BlogStaticContentResource\Pages;

use App\Filament\Resources\BlogStaticContentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogStaticContent extends CreateRecord
{
    protected static string $resource = BlogStaticContentResource::class;
}
