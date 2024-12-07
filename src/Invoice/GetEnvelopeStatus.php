<?php

namespace Ahmeti\Sovos\Invoice;

class GetEnvelopeStatus
{
    public function __construct(
        public string $soapAction = 'getEnvelopeStatus',
        public string $methodName = 'getEnvelopeStatusRequest',
        public ?string $Identifier = null,
        public ?string $VKN_TCKN = null,
        public ?string $UUID = null,
        public ?string $Parameters = null
    ) {}
}
