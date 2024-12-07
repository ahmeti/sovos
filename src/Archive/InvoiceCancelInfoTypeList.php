<?php

namespace Ahmeti\Sovos\Archive;

class InvoiceCancelInfoTypeList
{
    public function __construct(
        public ?string $invoiceId,
        public ?string $vkn,
        public ?string $branch,
        public ?string $totalAmount,
        public ?string $cancelDate,
        public ?string $custInvID,
    ) {}
}
