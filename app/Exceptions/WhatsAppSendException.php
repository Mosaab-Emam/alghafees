<?php

namespace App\Exceptions;

use RuntimeException;

class WhatsAppSendException extends RuntimeException
{
    public function __construct(public readonly string $reason, public readonly bool $stopBatch = false)
    {
        // Only a fixed reason is exposed or logged, never the API response or message text.
        parent::__construct($reason);
    }
}
