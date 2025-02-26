<?php

namespace Ahmeti\Sovos\Invoice;

class GetEnvelopeStatus
{
    public function __construct(
        public string $Identifier,
        public string $VKN_TCKN,
        public string|array $UUID,
        public ?string $Parameters = null,

        public string $soapAction = 'getEnvelopeStatus',
        public string $methodName = 'getEnvelopeStatusRequest'
    ) {}
}
