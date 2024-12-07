<?php

namespace Ahmeti\Sovos\Archive;

class GetSignedInvoiceResponse
{
    public function __construct(
        public ?string $UUID = null,
        public ?string $vkn = null,
        public ?string $invoiceNumber = null,
        public ?string $Detail = null,
        public ?string $Hash = null,
        public ?string $binaryData = null
    ) {}
}
