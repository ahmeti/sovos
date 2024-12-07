<?php

namespace Ahmeti\Sovos\Api;

use Ahmeti\Sovos\Archive\CancelInvoice;
use Ahmeti\Sovos\Archive\CancelInvoiceResponse;
use Ahmeti\Sovos\Archive\GetInvoiceDocument;
use Ahmeti\Sovos\Archive\GetInvoiceDocumentResponse;
use Ahmeti\Sovos\Archive\GetReportData;
use Ahmeti\Sovos\Archive\GetReportDataResponse;
use Ahmeti\Sovos\Archive\GetReportList;
use Ahmeti\Sovos\Archive\GetReportListResponse;
use Ahmeti\Sovos\Archive\GetReportStatus;
use Ahmeti\Sovos\Archive\GetReportStatusResponse;
use Ahmeti\Sovos\Archive\GetSignedInvoice;
use Ahmeti\Sovos\Archive\GetSignedInvoiceResponse;
use Ahmeti\Sovos\Archive\GetUserList;
use Ahmeti\Sovos\Archive\GetUsertListResponse;
use Ahmeti\Sovos\Archive\RetriggerOperation;
use Ahmeti\Sovos\Archive\RetriggerOperationResponse;
use Ahmeti\Sovos\Archive\SendEnvelope;
use Ahmeti\Sovos\Archive\SendEnvelopeResponse;
use Ahmeti\Sovos\Archive\SendInvoice;
use Ahmeti\Sovos\Archive\SendInvoiceResponse;

class ArchiveService extends Service
{
    protected string $url_test = 'https://earsivwstest.fitbulut.com/ClientEArsivServicesPort.svc';

    protected string $url_prod = 'https://earsivws.fitbulut.com/ClientEArsivServicesPort.svc';

    protected string $soapXmlPref = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:get="{namespace}">'.
        '<soapenv:Header/><soapenv:Body>%s</soapenv:Body></soapenv:Envelope>';

    protected string $soapSubClassPrefix = 'get';

    protected function makeXml(string $methodName, array $variables, ?string $prefix = null, ?string $namespace = null): string
    {
        $subXml = '';
        foreach ($variables as $key => $val) {
            if (is_array($val) && count($val) == 0) {
                $subXml .= '<'.($prefix ? $this->soapSubClassPrefix.':' : '').$key.'/>';
            } else {
                $subXml .= '<'.($prefix ? $this->soapSubClassPrefix.':' : '').$key.'>';
                if (is_array($val) || is_object($val)) {
                    $this->makeSubXml($val, $subXml, $prefix, $namespace);
                } else {
                    if (is_string($val) && strlen($val) > 0) {
                        $subXml .= $val;
                    }
                }

                $subXml .= '</'.($prefix ? $this->soapSubClassPrefix.':' : '').$key.'>';
            }
        }
        $treeXml = '<'.$this->soapSubClassPrefix.':'.$methodName.'>'.$subXml.'</'.$this->soapSubClassPrefix.':'.$methodName.'>';
        $replaced = str_replace('{namespace}', $namespace, $this->soapXmlPref);
        $mainXml = sprintf($replaced, $treeXml);

        return trim($mainXml);
    }

    protected function fillObj(object $object, object $data): object
    {
        $arr = [];
        $this->xml2array($data, $arr);
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                $pathClass = '\\Ahmeti\\Sovos\\Archive\\'.$key;
                $nobje = new $pathClass;
                foreach ($val as $key2 => $val2) {
                    $nobje->{$key2} = $val2;
                }
                $object->{$key} = $nobje;
            } else {
                $object->{$key} = $val;
            }
        }

        return $object;
    }

    public function GetInvoiceDocumentRequest(GetInvoiceDocument $request): GetInvoiceDocumentResponse
    {
        $soap = $this->getXml($this->request($request));
        $responseData = $soap->xpath('//s:Body')[0];
        $responseObj = new GetInvoiceDocumentResponse;
        $this->fillObj($responseObj, $responseData->getInvoiceDocumentResponseType);

        return $responseObj;
    }

    public function GetSignedInvoiceRequest(GetSignedInvoice $request): GetSignedInvoiceResponse
    {
        $soap = $this->getXml($this->request($request));
        $responseData = $soap->xpath('//s:Body')[0];
        $responseObj = new GetSignedInvoiceResponse;
        $this->fillObj($responseObj, $responseData->getSignedInvoiceResponseType);

        return $responseObj;
    }

    public function GetUserListRequest(GetUserList $request): GetUsertListResponse
    {
        $soap = $this->getXml($this->request($request));
        $responseData = $soap->xpath('//s:Body')[0];
        $responseObj = new GetUsertListResponse;
        $this->fillObj($responseObj, $responseData->getUserListResponse);

        return $responseObj;
    }

    public function GetRetriggerOperationRequest(RetriggerOperation $request): RetriggerOperationResponse
    {
        $soap = $this->getXml($this->request($request));
        $responseData = $soap->xpath('//s:Body')[0];
        $responseObj = new RetriggerOperationResponse;
        $this->fillObj($responseObj, $responseData->retriggerServiceResponse);

        return $responseObj;
    }

    public function CancelInvoiceRequest(CancelInvoice $request): CancelInvoiceResponse
    {
        $soap = $this->getXml($this->request($request));
        $responseData = $soap->xpath('//s:Body')[0];
        $responseObj = new CancelInvoiceResponse;
        $this->fillObj($responseObj, $responseData->invoiceCancellationServiceResponseType);

        return $responseObj;
    }

    public function SendInvoiceRequest(SendInvoice $request): SendInvoiceResponse
    {
        $soap = $this->getXml($this->request($request));
        $responseData = $soap->xpath('//s:Body')[0];
        $responseObj = new SendInvoiceResponse;
        $this->fillObj($responseObj, $responseData->sendInvoiceResponseType);

        return $responseObj;
    }

    public function SendEnvelopeRequest(SendEnvelope $request): SendEnvelopeResponse
    {
        $soap = $this->getXml($this->request($request));
        $responseData = $soap->xpath('//s:Body')[0];
        $responseObj = new SendEnvelopeResponse;
        $this->fillObj($responseObj, $responseData->sendInvoiceResponseType);

        return $responseObj;
    }

    public function GetReportList(GetReportList $request): GetReportListResponse
    {
        $responseText = $this->request($request);
        $soap = $this->getXml($responseText);
        $responseData = $soap->xpath('//s:Body')[0];

        return new GetReportListResponse(
            Result: $responseData->getReportListResponse->Result,
            Reports: $responseData->getReportListResponse->Reports,
        );
    }

    public function GetReportData(GetReportData $request): GetReportDataResponse
    {
        $soap = $this->getXml($this->request($request));
        $responseData = $soap->xpath('//s:Body')[0];
        $responseObj = new GetReportDataResponse;
        $this->fillObj($responseObj, $responseData->getReportDataResponse);

        return $responseObj;
    }

    public function GetReportStatus(GetReportStatus $request): GetReportStatusResponse
    {
        $soap = $this->getXml($this->request($request));
        $responseData = $soap->xpath('//s:Body')[0];
        $responseObj = new GetReportStatusResponse;
        $this->fillObj($responseObj, $responseData->getReportStatusResponseType);

        return $responseObj;
    }
}
