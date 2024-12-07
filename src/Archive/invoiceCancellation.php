<?php

namespace Ahmeti\Sovos\Archive;

class invoiceCancellation
{
    public function __construct(
        public ?string $code = null,
        public ?string $message = null
    ) {}
}
