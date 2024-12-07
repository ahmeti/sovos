<?php

namespace Ahmeti\Sovos\Api;

use Ahmeti\Sovos\Despatch\GetDesEnvelopeStatus;
use Ahmeti\Sovos\Despatch\GetDesEnvelopeStatusResponse;
use Ahmeti\Sovos\Despatch\GetDesUBL;
use Ahmeti\Sovos\Despatch\GetDesUBLList;
use Ahmeti\Sovos\Despatch\GetDesUBLListResponse;
use Ahmeti\Sovos\Despatch\GetDesUBLResponse;
use Ahmeti\Sovos\Despatch\GetDesUserList;
use Ahmeti\Sovos\Despatch\GetDesUserListResponse;
use Ahmeti\Sovos\Despatch\GetDesView;
use Ahmeti\Sovos\Despatch\GetDesViewResponse;
use Ahmeti\Sovos\Despatch\SendDespatch;
use Ahmeti\Sovos\Despatch\SendDespatchResponse;

class DespatchService extends Service
{
    protected string $url_test = 'https://efaturawstest.fitbulut.com/ClientEDespatchServicePort.svc';

    protected string $url_prod = 'https://efaturaws.fitbulut.com/ClientEDespatchServicePort.svc';

    protected string $soapXmlPref = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:edes="http://foriba.com/eDespatch/">'.
        '<soapenv:Header/><soapenv:Body>%s</soapenv:Body></soapenv:Envelope>';

    protected string $soapSubClassPrefix = 'edes';

    public function GetUblListRequest(GetDesUBLList $request): array
    {
        $soap = $this->getXml($this->request($request));
        $ublList = $soap->xpath('//s:Body')[0];
        $list = [];
        foreach ($ublList->getDesUBLListResponse->Response as $response) {
            $responseObj = new GetDesUBLListResponse;
            $list[] = $this->fillObj($responseObj, $response);
        }

        return $list;
    }

    public function GetUblRequest(GetDesUBL $request): array
    {
        $soap = $this->getXml($this->request($request));
        $ubl = $soap->xpath('//s:Body')[0];
        $list = [];
        $responses = count($ubl->getDesUBLResponse->Response) > 1 ? $ubl->getDesUBLResponse->Response : [$ubl->getDesUBLResponse->Response];
        foreach ($responses as $response) {
            $list[] = new GetDesUBLResponse(DocData: (string) $response->DocData, DocType: $response->Parameters);
        }

        return $list;
    }

    public function GetDesEnvelopeStatusRequest(GetDesEnvelopeStatus $request): array
    {
        $soap = $this->getXml($this->request($request));
        $ublList = $soap->xpath('//s:Body')[0];
        $list = [];
        foreach ($ublList->getDesEnvelopeStatusResponse->Response as $response) {
            $responseObj = new GetDesEnvelopeStatusResponse;
            $list[] = $this->fillObj($responseObj, $response);
        }

        return $list;
    }

    public function SendUBLRequest(SendDespatch $request): array
    {
        $soap = $this->getXml($this->request($request));
        $ublList = $soap->xpath('//s:Body')[0];
        $list = [];
        foreach ($ublList->sendDesUBLResponse->Response as $response) {
            $responseObj = new SendDespatchResponse;
            $list[] = $this->fillObj($responseObj, $response);
        }

        return $list;
    }

    public function GetDesUserListRequest(GetDesUserList $request): array
    {
        $soap = $this->getXml($this->request($request));
        $ubl = $soap->xpath('//s:Body')[0];
        $list = [];
        $responses = count($ubl->getDesUserListResponse->DocData) > 1 ? $ubl->getDesUserListResponse->DocData : [$ubl->getDesUserListResponse->DocData];
        foreach ($responses as $response) {
            $list[] = new GetDesUserListResponse(DocData: (string) $response);
        }

        return $list;
    }

    public function GetDesViewRequest(GetDesView $request): array
    {
        $soap = $this->getXml($this->request($request));
        $ubl = $soap->xpath('//s:Body')[0];
        $list = [];
        $responses = count($ubl->getDesViewResponse->Response) > 1 ? $ubl->getDesViewResponse->Response : [$ubl->getDesViewResponse->Response];
        foreach ($responses as $response) {
            $responseObj = new GetDesViewResponse;
            $list[] = $this->fillObj($responseObj, $response);
        }

        return $list;
    }
}
