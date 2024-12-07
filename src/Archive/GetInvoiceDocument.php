<?php

namespace Ahmeti\Sovos\Archive;

class GetInvoiceDocument
{
    public function __construct(
        public string $soapAction = 'getInvoiceDocument',
        public string $methodName = 'getInvoiceDocumentRequestType',
        public bool $prefix = false,
        public string $namespace = 'http://fitcons.com/earchive/invoice',
        public ?string $UUID = null,
        public ?string $vkn = null,
        public ?string $invoiceNumber = null,
        public ?string $outputType = null,
        public ?string $custInvId = null
    ) {}
}
