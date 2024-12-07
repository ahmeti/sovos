<?php

namespace Ahmeti\Sovos\Despatch;

class GetDesViewResponse
{
    public function __construct(
        public ?string $UUID = null,
        public ?string $Type = null,
        public ?string $DocType = null,
        public ?string $ViewType = null,
        public ?string $DocData = null,
        public ?string $Result = null
    ) {}
}
