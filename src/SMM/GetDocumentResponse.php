<?php

namespace Ahmeti\Sovos\SMM;

class GetDocumentResponse
{
    public function __construct(
        public ?string $UUID = null,
        public ?string $ID = null,
        public ?string $Type = null,
        public ?string $ViewType = null,
        public ?string $DocData = null
    ) {}
}
