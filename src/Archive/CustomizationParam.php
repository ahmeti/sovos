<?php

namespace Ahmeti\Sovos\Archive;

class CustomizationParam
{
    public function __construct(
        public ?string $paramName = null,
        public ?string $paramValue = null
    ) {}
}
