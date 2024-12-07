<?php

namespace Ahmeti\Sovos\Archive;

class preCheckSuccess
{
    public function __construct(
        public ?string $UUID = null,
        public ?string $Vkn = null,
        public ?string $InvoiceNumber = null,
        public ?string $SuccessCode = null,
        public ?string $SuccessDesc = null,
        public ?string $Filename = null,
        public ?string $sha256Hash = null,
        public ?string $binaryData = null
    ) {}
}
