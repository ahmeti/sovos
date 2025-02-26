<?php

namespace Ahmeti\Sovos\Invoice;

class GetEnvelopeStatusResponse
{
    public function __construct(
        public string $UUID,
        public string $IssueDate,
        public string $DocumentTypeCode,
        public string $DocumentType,
        public string $ResponseCode,
        public string $Description
    ) {}
}
