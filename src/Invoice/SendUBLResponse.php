<?php

namespace Ahmeti\Sovos\Invoice;

class SendUBLResponse
{
    public function __construct(
        public ?string $EnvUUID = null,
        public ?string $UUID = null,
        public ?string $ID = null,
        public ?string $CustInvID = null
    ) {}
}
