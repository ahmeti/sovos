<?php

namespace Ahmeti\Sovos\Invoice;

class GetInvoiceViewResponse
{
    public function __construct(
        public ?string $DocType = null,
        public ?string $DocData = null,
    ) {}
}
