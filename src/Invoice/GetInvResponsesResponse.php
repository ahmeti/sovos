<?php

namespace Ahmeti\Sovos\Invoice;

use Ahmeti\Sovos\Invoice\Utils\InvResponses;

class GetInvResponsesResponse
{
    public function __construct(
        public string $InvoiceUUID,
        public ?InvResponses $InvResponses = null,
    ) {}
}
