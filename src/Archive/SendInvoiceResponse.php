<?php

namespace Ahmeti\Sovos\Archive;

class SendInvoiceResponse
{
    public function __construct(
        public ?string $Detail = null,
        public ?Result $Result = null,
        public ?preCheckErrorResults $preCheckErrorResults = null,
        public ?preCheckSuccessResults $preCheckSuccessResults = null
    ) {}
}
