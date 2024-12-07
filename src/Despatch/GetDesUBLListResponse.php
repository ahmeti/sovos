<?php

namespace Ahmeti\Sovos\Despatch;

class GetDesUBLListResponse
{
    public function __construct(
        public ?string $UUID = null,
        public ?string $Identifier = null,
        public ?string $VKN_TCKN = null,
        public ?string $EnvType = null,
        public ?string $InsertDateTime = null,
        public ?string $ID = null,
        public ?string $EnvUUID = null,
    ) {}
}
