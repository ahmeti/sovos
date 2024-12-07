<?php

namespace Ahmeti\Sovos\Despatch;

class GetDesView
{
    /**
     * @param  $DocDetails  DocDetails[]
     */
    public function __construct(
        public ?string $soapAction = null,
        public ?string $methodName = null,
        public ?string $Identifier = null,
        public ?string $VKN_TCKN = null,
        public array $DocDetails = [],
    ) {}
}
