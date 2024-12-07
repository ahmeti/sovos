<?php

namespace Ahmeti\Sovos\SMM;

class CancelDocument
{
    public function __construct(
        public string $soapAction = 'cancelDocument',
        public string $methodName = 'cancelDocumentRequest',
        public bool $prefix = true,
        public string $namespace = 'http://foriba.com/eSmm/',
        public ?string $VKN_TCKN = null,
        public string $Branch = 'default',
        public array $CancelDocDetails = []
    ) {}
}
