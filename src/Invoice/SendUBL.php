<?php

namespace Ahmeti\Sovos\Invoice;

class SendUBL
{
    public function __construct(
        public string $soapAction = 'sendUBL',
        public string $methodName = 'sendUBLRequest',
        public ?string $VKN_TCKN = null,
        public ?string $SenderIdentifier = null,
        public ?string $ReceiverIdentifier = null,
        public ?string $DocType = null,
        public ?string $DocData = null
    ) {}
}
