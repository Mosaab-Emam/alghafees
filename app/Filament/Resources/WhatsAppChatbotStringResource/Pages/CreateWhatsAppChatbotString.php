<?php

namespace App\Filament\Resources\WhatsAppChatbotStringResource\Pages;

use App\Filament\Resources\WhatsAppChatbotStringResource;
use App\Services\WhatsAppChatbotStringsService;
use Filament\Resources\Pages\CreateRecord;

class CreateWhatsAppChatbotString extends CreateRecord
{
    protected static string $resource = WhatsAppChatbotStringResource::class;

    protected function afterCreate(): void
    {
        app(WhatsAppChatbotStringsService::class)->clearCache();
    }
}
