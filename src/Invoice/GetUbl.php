<?php

namespace Ahmeti\Sovos\Invoice;

class GetUbl
{
    public function __construct(
        public string $soapAction = 'getUBL',
        public string $methodName = 'getUBLRequest',
        public ?string $Identifier = null,
        public ?string $VKN_TCKN = null,
        public ?string $UUID = null,
        public ?string $DocType = null,
        public ?string $Type = null,
        public ?string $Parameters = null
    ) {}
}
