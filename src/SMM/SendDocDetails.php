<?php

namespace Ahmeti\Sovos\SMM;

class SendDocDetails
{
    public function __construct(
        public ?string $UUID = null,
        public ?string $Type = null,
        public ?string $DocType = null,
        public ?string $DocData = null,
        public ?string $ViewType = null,
        public ?string $Parameters = null
    ) {}
}
