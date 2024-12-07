<?php

namespace Ahmeti\Sovos\Invoice;

class GetUserList
{
    public function __construct(
        public string $soapAction = 'getUserList',
        public string $methodName = 'getUserListRequest',
        public ?string $Identifier = null,
        public ?string $VKN_TCKN = null,
        public ?string $Role = null,
        public ?string $RegisteredAfter = null,
        public ?string $Filter_VKN_TCKN = null
    ) {}
}
