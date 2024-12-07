<?php

namespace Ahmeti\Sovos\Invoice;

class GetUserListResponse
{
    public function __construct(
        public ?string $Identifier = null,
        public ?string $Alias = null,
        public ?string $Title = null,
        public ?string $Type = null,
        public ?string $RegisterTime = null,
        public ?string $FirstCreationTime = null
    ) {}
}
