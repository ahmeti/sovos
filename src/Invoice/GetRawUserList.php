<?php

namespace Ahmeti\Sovos\Invoice;

class GetRawUserList
{
    public function __construct(
        public string $soapAction = 'getRAWUserList',
        public string $methodName = 'getRAWUserListRequest',
        public ?string $Identifier = null,
        public ?string $VKN_TCKN = null,
        public ?string $Role = null,
        public ?string $Parameters = null
    ) {}
}
