<?php

namespace App\Filament\Resources\WhatsAppChatbotStringResource\Pages;

use App\Filament\Resources\WhatsAppChatbotStringResource;
use App\Services\WhatsAppChatbotStringsService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWhatsAppChatbotString extends EditRecord
{
    protected static string $resource = WhatsAppChatbotStringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        app(WhatsAppChatbotStringsService::class)->clearCache();
    }
}
