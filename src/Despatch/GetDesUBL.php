<?php

namespace Ahmeti\Sovos\Despatch;

class GetDesUBL
{
    public function __construct(
        public string $soapAction = 'getDesUBL',
        public string $methodName = 'getDesUBLRequest',
        public ?string $Identifier = null,
        public ?string $VKN_TCKN = null,
        public ?string $UUID = null,
        public ?string $DocType = null,
        public ?string $Type = null,
        public ?string $Parameters = null
    ) {}
}
