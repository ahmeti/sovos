<?php

namespace Ahmeti\Sovos\Invoice;

class GetInvoiceView
{
    public function __construct(
        public string $soapAction = 'getInvoiceView',
        public string $methodName = 'getInvoiceViewRequest',
        public ?string $UUID = null,
        public ?string $CustInvID = null,
        public ?string $Identifier = null,
        public ?string $VKN_TCKN = null,
        public ?string $Type = null,
        public ?string $DocType = null,
    ) {}
}
