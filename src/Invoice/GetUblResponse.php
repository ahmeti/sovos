<?php

namespace Ahmeti\Sovos\Invoice;

class GetUblResponse
{
    public function __construct(
        public ?string $DocData = null,
        public ?string $DocType = null
    ) {}
}
