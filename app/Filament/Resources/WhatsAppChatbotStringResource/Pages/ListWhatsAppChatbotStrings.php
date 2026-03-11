<?php

namespace App\Filament\Resources\WhatsAppChatbotStringResource\Pages;

use App\Filament\Resources\WhatsAppChatbotStringResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWhatsAppChatbotStrings extends ListRecords
{
    protected static string $resource = WhatsAppChatbotStringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
