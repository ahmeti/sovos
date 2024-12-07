<?php

namespace Ahmeti\Sovos\SMM;

class CancelDocumentResponse
{
    public function __construct(
        public ?string $ID = null,
        public ?string $CustDocID = null,
        public ?string $Type = null,
        public ?string $DocType = null,
        public ?string $Result = null,
        public ?string $ResultDescription = null
    ) {}
}
