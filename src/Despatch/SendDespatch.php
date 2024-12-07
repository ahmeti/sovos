<?php

namespace Ahmeti\Sovos\Despatch;

class SendDespatch
{
    public function __construct(
        public string $soapAction = 'sendDesUBL',
        public string $methodName = 'sendDesUBLRequest',
        public ?string $VKN_TCKN = null,
        public ?string $SenderIdentifier = null,
        public ?string $ReceiverIdentifier = null,
        public ?string $DocType = null,
        public ?string $DocData = null
    ) {}
}
