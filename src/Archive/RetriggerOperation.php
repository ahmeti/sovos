<?php

namespace Ahmeti\Sovos\Archive;

class RetriggerOperation
{
    /**
     * @param  CustomizationParam[]  $customizationParams
     */
    public function __construct(
        public string $soapAction = 'retriggerOperation',
        public string $methodName = 'retriggerServiceRequest',
        public bool $prefix = false,
        public string $namespace = 'http://fitcons.com/earchive/invoice',
        public ?string $VKN = null,
        public ?string $branch = null,
        public ?string $invoiceID = null,
        public ?string $invoiceUUID = null,
        public array $customizationParams = []
    ) {}
}
