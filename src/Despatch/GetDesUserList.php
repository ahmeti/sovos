<?php

namespace Ahmeti\Sovos\Despatch;

class GetDesUserList
{
    public function __construct(
        public string $soapAction = 'getDesUserList',
        public string $methodName = 'getDesUserListRequest',
        public ?string $Identifier = null,
        public ?string $VKN_TCKN = null,
        public ?string $Role = null,
        public ?string $Parameters = null,
    ) {}
}
