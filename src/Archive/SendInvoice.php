<?php

namespace Ahmeti\Sovos\Archive;

class SendInvoice
{
    public function __construct(
        public string $soapAction = 'sendInvoice',
        public string $methodName = 'sendInvoiceRequestType',
        public bool $prefix = false,
        public string $namespace = 'http://fitcons.com/earchive/invoice',
        public ?string $senderID = null,
        public ?string $receiverID = null,
        public ?string $docType = null,
        public ?string $fileName = null,
        public ?string $hash = null,
        public ?string $binaryData = null,
        public array $customizationParams = [],
        public ?responsiveOutput $responsiveOutput = null
    ) {}
}
