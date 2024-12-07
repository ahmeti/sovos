<?php

namespace Ahmeti\Sovos\Api;

use Ahmeti\Sovos\Invoice\GetEnvelopeStatus;
use Ahmeti\Sovos\Invoice\GetEnvelopeStatusResponse;
use Ahmeti\Sovos\Invoice\GetInvoiceView;
use Ahmeti\Sovos\Invoice\GetInvoiceViewResponse;
use Ahmeti\Sovos\Invoice\GetRawUserList;
use Ahmeti\Sovos\Invoice\GetRawUserListResponse;
use Ahmeti\Sovos\Invoice\GetUbl;
use Ahmeti\Sovos\Invoice\GetUblList;
use Ahmeti\Sovos\Invoice\GetUblListResponse;
use Ahmeti\Sovos\Invoice\GetUblResponse;
use Ahmeti\Sovos\Invoice\GetUserList;
use Ahmeti\Sovos\Invoice\GetUserListResponse;
use Ahmeti\Sovos\Invoice\SendUBL;
use Ahmeti\Sovos\Invoice\SendUBLResponse;

class InvoiceService extends Service
{
    protected string $url_test = 'https://efaturawstest.fitbulut.com/ClientEInvoiceServices/ClientEInvoiceServicesPort.svc';

    protected string $url_prod = 'https://efaturaws.fitbulut.com/ClientEInvoiceServices/ClientEInvoiceServicesPort.svc';

    protected string $soapXmlPref = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ein="http:/fitcons.com/eInvoice/">'.
        '<soapenv:Header/><soapenv:Body>%s</soapenv:Body></soapenv:Envelope>';

    protected string $soapSubClassPrefix = 'ein';

    public function GetUserListRequest(GetUserList $request): array
    {
        $soap = $this->getXml($this->request($request));
        $userlist = $soap->xpath('//s:Body')[0];
        $list = [];
        foreach ($userlist->getUserListResponse->User as $user) {
            $responseObj = new GetUserListResponse;
            $list[] = $this->fillObj($responseObj, $user);
        }

        return $list;
    }

    public function GetUblListRequest(GetUblList $request): array
    {
        $soap = $this->getXml($this->request($request));
        $ublList = $soap->xpath('//s:Body')[0];
        $list = [];
        foreach ($ublList->getUBLListResponse->UBLList as $ubl) {
            $responseObj = new GetUblListResponse;
            $list[] = $this->fillObj($responseObj, $ubl);
        }

        return $list;
    }

    public function GetInvoiceViewRequest(GetInvoiceView $request): GetInvoiceViewResponse
    {
        $soap = $this->getXml($this->request($request));
        $body = $soap->xpath('//s:Body')[0];

        return new GetInvoiceViewResponse(
            DocType: $request->DocType,
            DocData: (string) $body->getInvoiceViewResponse->DocData);
    }

    public function GetUblRequest(GetUbl $request): array
    {
        $soap = $this->getXml($this->request($request));
        $ubl = $soap->xpath('//s:Body')[0];
        $list = [];

        $responses = count($ubl->getUBLResponse->DocData) > 1 ? $ubl->getUBLResponse->DocData : [$ubl->getUBLResponse->DocData];
        foreach ($responses as $response) {
            $list[] = new GetUblResponse(DocData: (string) $response, DocType: $request->Parameters);
        }

        return $list;
    }

    public function GetEnvelopeStatusRequest(GetEnvelopeStatus $request): array
    {
        $soap = $this->getXml($this->request($request));
        $ublList = $soap->xpath('//s:Body')[0];
        $list = [];
        foreach ($ublList->getEnvelopeStatusResponse->Response as $response) {
            $responseObj = new GetEnvelopeStatusResponse;
            $list[] = $this->fillObj($responseObj, $response);
        }

        return $list;
    }

    public function SendUBLRequest(SendUBL $request): array
    {
        $soap = $this->getXml($this->request($request));
        $ublList = $soap->xpath('//s:Body')[0];
        $list = [];
        foreach ($ublList->sendUBLResponse->Response as $response) {
            $responseObj = new SendUBLResponse;
            $list[] = $this->fillObj($responseObj, $response);
        }

        return $list;
    }

    public function GetRawUserListRequest(GetRawUserList $request): GetRawUserListResponse
    {
        $soap = $this->getXml($this->request($request));
        $body = $soap->xpath('//s:Body')[0];

        return new GetRawUserListResponse(
            DocData: $body->getRAWUserListResponse->DocData
        );

    }
}
