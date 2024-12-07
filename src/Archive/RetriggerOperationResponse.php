<?php

namespace Ahmeti\Sovos\Archive;

class RetriggerOperationResponse
{
    public function __construct(
        public ?string $Result = null,
        public ?string $responseCode = null,
        public ?string $responsedetail = null
    ) {}
}
