<?php

namespace Ahmeti\Sovos\SMM;

class GetDocument
{
    public function __construct(
        public string $soapAction = 'getDocument',
        public string $methodName = 'getDocumentRequest',
        public bool $prefix = false,
        public string $namespace = 'http://foriba.com/eSmm/',
        public ?string $VKN_TCKN = null,
        public array $GetDocDetails = [],
    ) {}
}
