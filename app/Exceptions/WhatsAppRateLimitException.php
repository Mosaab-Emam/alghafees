<?php

namespace App\Exceptions;

use RuntimeException;

class WhatsAppRateLimitException extends RuntimeException
{
    public function __construct(public readonly int $retryAfter)
    {
        parent::__construct('WhatsApp sending rate limit reached.');
    }
}
