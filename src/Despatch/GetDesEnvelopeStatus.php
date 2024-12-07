<?php

namespace Ahmeti\Sovos\Despatch;

class GetDesEnvelopeStatus
{
    public function __construct(
        public string $soapAction = 'getDesEnvelopeStatus',
        public string $methodName = 'getDesEnvelopeStatusRequest',
        public ?string $Identifier = null,
        public ?string $VKN_TCKN = null,
        public ?string $UUID = null,
        public ?string $Parameters = null,
    ) {}
}
