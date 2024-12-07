<?php

namespace Ahmeti\Sovos\SMM;

class CancelDocDetails
{
    public function __construct(
        public ?string $ID = null,
        public ?string $CustDocID = null,
        public ?string $Type = null,
        public ?string $DocType = null,
        public ?string $TotalAmount = null,
        public ?string $CancelDate = null,
        public ?string $Parameters = null
    ) {}
}
