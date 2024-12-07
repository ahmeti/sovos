<?php

namespace Ahmeti\Sovos\Archive;

class GetSignedInvoice
{
    public function __construct(
        public string $soapAction = 'getSignedInvoice',
        public string $methodName = 'getSignedInvoiceRequestType',
        public bool $prefix = false,
        public string $namespace = 'http://fitcons.com/earchive/invoice',
        public ?string $UUID = null,
        public ?string $vkn = null,
        public ?string $invoiceNumber = null,
        public ?string $custInvID = null
    ) {}
}
