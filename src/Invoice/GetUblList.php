<?php

namespace Ahmeti\Sovos\Invoice;

class GetUblList
{
    /**
     * @param  string|null  $DocType  INVOICE or ENVOLOPE
     * @param  string|null  $Type  INBOUND or OUTBOUND
     * @param  string|null  $FromDate  2026-02-01T00:00:00.000000+03:00 formatında olmalıdır.
     * @param  string|null  $ToDate  2026-02-01T23:59:59.999999+03:00 formatında olmalıdır.
     */
    public function __construct(
        public string $soapAction = 'getUBLList',
        public string $methodName = 'getUBLListRequest',
        public ?string $Identifier = null,
        public ?string $VKN_TCKN = null,
        public ?string $UUID = null,
        public ?string $DocType = null,
        public ?string $Type = null,
        public ?string $FromDate = null,
        public ?string $ToDate = null,
        public bool $FromDateSpecified = false,
        public bool $ToDateSpecified = false
    ) {}
}
