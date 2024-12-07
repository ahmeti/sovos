<?php

namespace Ahmeti\Sovos\Archive;

class GetReportStatus
{
    public function __construct(
        public string $soapAction = 'getReportStatus',
        public string $methodName = 'getReportStatusRequestType',
        public bool $prefix = false,
        public string $namespace = 'http://fitcons.com/earchive/report',
        public ?string $UUID = null,
        public ?string $VKN = null
    ) {}
}
