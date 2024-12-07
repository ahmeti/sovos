<?php

namespace Ahmeti\Sovos\SMM;

class SendDocumentResponse
{
    public function __construct(
        public ?string $UUID = null,
        public ?string $ID = null,
        public ?string $CustDocID = null,
        public ?string $Type = null,
        public ?string $DocType = null,
        public ?string $ViewData = null,
    ) {}
}
