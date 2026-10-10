<?php

namespace App\Exceptions;

use RuntimeException;

class LeadImportException extends RuntimeException
{
    /** Each error contains row, column, value and message, ready for display or export. */
    public function __construct(public readonly array $errors)
    {
        parent::__construct(__('leads.import_failed'));
    }
}
