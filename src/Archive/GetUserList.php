<?php

namespace Ahmeti\Sovos\Archive;

class GetUserList
{
    public function __construct(
        public string $soapAction = 'getUserList',
        public string $methodName = 'getUserListRequest',
        public bool $prefix = true,
        public string $namespace = 'http:/fitcons.com/earchive/getuserlist',
        public ?string $vknTckn = null
    ) {}
}
