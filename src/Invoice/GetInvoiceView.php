<?php

namespace Ahmeti\Sovos\Invoice;

class GetInvoiceView
{
    /**
     * @param string|null $UUID Fatura ETTN
     * @param string|null $CustInvID Müşteri Fatura ID
     * @param string|null $Identifier Faturanın gönderici ya da alıcısına ait Gönderici Birim (GB) ya da Posta Kutusu (PK) numarası
     * @param string|null $VKN_TCKN Faturanın gönderici ya da alıcısına ait VKN/TCKN
     * @param string|null $Type Gelen/Gönderilen Fatura (OUTBOUND, INBOUND)
     * @param string|null $DocType Doküman Türü (HTML, PDF, XSLT, HTML_DEFAULT, PDF_DEFAULT)
     */
    public function __construct(
        public string $soapAction = 'getInvoiceView',
        public string $methodName = 'getInvoiceViewRequest',
        public ?string $UUID = null,
        public ?string $CustInvID = null,
        public ?string $Identifier = null,
        public ?string $VKN_TCKN = null,
        public ?string $Type = null,
        public ?string $DocType = null,
    ) {}
}
