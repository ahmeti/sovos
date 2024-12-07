<?php

namespace Ahmeti\Sovos\Archive;

class GetReportStatusResponse
{
    public function __construct(
        public ?string $Result = null,
        public ?string $StatusCode = null,
        public ?string $Detail = null
    ) {}
}
