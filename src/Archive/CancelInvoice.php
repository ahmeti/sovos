<?php

namespace Ahmeti\Sovos\Archive;

class CancelInvoice
{
    /**
     * @param  InvoiceCancelInfoTypeList[]  $invoiceCancelInfoTypeList
     */
    public function __construct(
        public string $soapAction = 'cancelInvoice',
        public string $methodName = 'invoiceCancellationServiceRequestType',
        public bool $prefix = false,
        public string $namespace = 'http://fitcons.com/earchive/invoicecancellation',
        public array $invoiceCancelInfoTypeList = []
    ) {}
}
