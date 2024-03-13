<?php

namespace App\Filament\Resources\RateRequestResource\Pages;

use App\Filament\Resources\RateRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRateRequest extends EditRecord
{
    protected static string $resource = RateRequestResource::class;

    protected static string | array $routeMiddleware = 'checkPermission:rates.edit';


}
