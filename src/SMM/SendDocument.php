<?php

namespace Ahmeti\Sovos\SMM;

class SendDocument
{
    public function __construct(
        public string $soapAction = 'sendDocument',
        public string $methodName = 'sendDocumentRequest',
        public bool $prefix = true,
        public string $namespace = 'http://foriba.com/eSmm/',
        public ?string $VKN_TCKN = null,
        public string $Branch = 'default',
        public array $SendDocDetails = [],
    ) {}
}
