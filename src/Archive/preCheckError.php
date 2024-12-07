<?php

namespace Ahmeti\Sovos\Archive;

class preCheckError
{
    public function __construct(
        public ?string $UUID = null,
        public ?string $Vkn = null,
        public ?string $InvoiceNumber = null,
        public ?string $ErrorCode = null,
        public ?string $ErrorDesc = null,
        public ?string $Filename = null
    ) {}
}
