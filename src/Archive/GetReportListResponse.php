<?php

namespace Ahmeti\Sovos\Archive;

class GetReportListResponse
{
    public function __construct(
        public ?string $Result = null,
        public ?string $Reports = null
    ) {}
}
