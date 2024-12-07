<?php

namespace Ahmeti\Sovos\Archive;

class GetReportList
{
    public function __construct(
        public string $soapAction = 'getReportList',
        public string $methodName = 'getReportListRequest',
        public bool $prefix = false,
        public string $namespace = 'http://fitcons.com/earchive/report',
        public ?string $startDate = null,
        public ?string $endDate = null,
        public ?string $vkn = null,
        public ?string $approved = null
    ) {}
}
