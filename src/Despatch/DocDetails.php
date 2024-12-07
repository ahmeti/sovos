<?php

namespace Ahmeti\Sovos\Despatch;

class DocDetails
{
    public function __construct(
        public ?string $UUID = null,
        public ?string $Type = null,
        public ?string $DocType = null,
        public ?string $ViewType = null,
    ) {}
}
