<?php

namespace Ahmeti\Sovos\Invoice;

/**
 * @param  string  $Type  OUTBOUND, INBOUND
 * @param  string  $Parameters  DOC_DATA
 */
class GetInvResponses
{
    public function __construct(
        public string $Identifier,
        public string $VKN_TCKN,
        public string|array $UUID,
        public string $Type,
        public ?string $Parameters = null,

        public string $soapAction = 'getInvResponses',
        public string $methodName = 'getInvResponsesRequest',
    ) {}
}
