<?php

namespace Ahmeti\Sovos\Invoice\Utils;

class InvResponses
{
    public function __construct(
        public string $EnvUUID,
        public string $UUID,
        public string $ID,
        public string $InsertDateTime,
        public string $IssueDate,
        public string $ARType,
        public string $ARNotes,
    ) {}
}
