<?php

namespace Ahmeti\Sovos\SMM;

class Parameters
{
    public function __construct(
        public ?string $Name = null,
        public ?string $Value = null,
    ) {}
}
