<?php

namespace Ahmeti\Sovos\Despatch;

class SendDespatchResponse
{
    public function __construct(
        public ?string $EnvUUID = null,
        public ?string $UUID = null,
        public ?string $ID = null,
        public ?string $CustDesID = null,
    ) {}
}
