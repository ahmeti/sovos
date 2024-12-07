<?php

namespace Ahmeti\Sovos\Archive;

class Reports
{
    public function __construct(
        public ?string $uuid = null,
        public ?string $tcknVkn = null,
        public ?string $periodCode = null,
        public ?string $sectionStartDate = null,
        public ?string $sectionEndDate = null,
        public ?string $partNumber = null,
        public ?string $invoiceCount = null,
        public ?string $invoiceTotalAmount = null,
        public ?string $cancelInvoiceCount = null,
        public ?string $calcelInvoiceTotalAmount = null,
        public ?string $gibStatus = null
    ) {}
}
