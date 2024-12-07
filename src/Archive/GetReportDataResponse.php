<?php

namespace Ahmeti\Sovos\Archive;

class GetReportDataResponse
{
    public function __construct(
        public ?string $Result = null,
        public ?string $Detail = null,
        public ?string $binaryData = null
    ) {}
}
