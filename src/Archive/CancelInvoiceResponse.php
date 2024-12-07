<?php

namespace Ahmeti\Sovos\Archive;

class CancelInvoiceResponse
{
    public function __construct(
        public ?string $Result = null,
        public ?string $invoiceCancellation = null
    ) {}
}
