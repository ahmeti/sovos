<?php

namespace Ahmeti\Sovos\Despatch;

class GetDesUBLResponse
{
    public function __construct(
        public ?string $DocData,
        public ?string $DocType
    ) {}
}
