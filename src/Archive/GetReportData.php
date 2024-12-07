<?php

namespace Ahmeti\Sovos\Archive;

class GetReportData
{
    public function __construct(
        public string $soapAction = 'getReportData',
        public string $methodName = 'getReportDataRequest',
        public bool $prefix = false,
        public string $namespace = 'http://fitcons.com/earchive/report',
        public ?string $UUID = null,
        public ?string $VKN_TCKN = null
    ) {}
}
