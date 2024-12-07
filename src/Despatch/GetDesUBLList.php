<?php

namespace Ahmeti\Sovos\Despatch;

class GetDesUBLList
{
    public function __construct(
        public string $soapAction = 'getDesUBLList',
        public string $methodName = 'getDesUBLListRequest',
        public ?string $Identifier = null,
        public ?string $VKN_TCKN = null,
        public ?string $UUID = null,
        public ?string $DocType = null,
        public ?string $Type = null,
        public ?string $FromDate = null,
        public ?string $ToDate = null
    ) {}
}
