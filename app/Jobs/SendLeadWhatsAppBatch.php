<?php

namespace App\Jobs;

use App\Services\LeadWhatsAppBatchService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendLeadWhatsAppBatch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 0;

    public int $timeout = 45;

    public bool $failOnTimeout = true;

    public function __construct(public string $batchId, public int $ownerId)
    {
        $this->onConnection('lead_whatsapp');
        $this->onQueue('lead-whatsapp');
    }

    public function handle(LeadWhatsAppBatchService $service): void
    {
        if (($delay = $service->process($this->batchId, $this->ownerId)) !== null) {
            $this->release(max(1, $delay));
        }
    }

    public function failed(?Throwable $exception): void
    {
        Log::error('Lead WhatsApp batch stopped', ['batch_id' => $this->batchId, 'exception' => $exception ? get_class($exception) : null]);
        app(LeadWhatsAppBatchService::class)->fail($this->batchId, $this->ownerId);
    }
}
