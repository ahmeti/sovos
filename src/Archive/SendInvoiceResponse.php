<?php

namespace Ahmeti\Sovos\Archive;

class SendInvoiceResponse
{
    public function __construct(
        public ?string $Detail = null,
        public ?string $Result = null,
        public ?string $preCheckErrorResults = null,
        public ?string $preCheckSuccessResults = null
    ) {}
}
