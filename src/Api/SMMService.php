<?php

namespace Ahmeti\Sovos\Api;

use Ahmeti\Sovos\SMM\CancelDocument;
use Ahmeti\Sovos\SMM\CancelDocumentResponse;
use Ahmeti\Sovos\SMM\GetDocument;
use Ahmeti\Sovos\SMM\GetDocumentResponse;
use Ahmeti\Sovos\SMM\SendDocument;
use Ahmeti\Sovos\SMM\SendDocumentResponse;

class SMMService extends Service
{
    protected string $url_test = 'https://earsivwstest.fitbulut.com/ClientESmmServicesPort.svc';

    protected string $url_prod = 'https://earsivws.fitbulut.com/ClientESmmServicesPort.svc';

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
                    if (strlen($val) > 0) {
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
                $pathClass = '\\Ahmeti\\Sovos\\SMM\\'.$key;
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

    public function GetDocumentRequest(GetDocument $request): GetDocumentResponse
    {
        $soap = $this->getXml($this->request($request));
        $responseData = $soap->xpath('//s:Body')[0];
        $responseObj = new GetDocumentResponse;
        $this->fillObj($responseObj, $responseData->getDocumentResponse->getDocumentResponse);

        return $responseObj;
    }

    public function SendDocumentRequest(SendDocument $request): SendDocumentResponse
    {
        $soap = $this->getXml($this->request($request));
        $responseData = $soap->xpath('//s:Body')[0];
        $responseObj = new SendDocumentResponse;
        $this->fillObj($responseObj, $responseData->sendDocumentResponse->SendDocumentResponse);

        return $responseObj;
    }

    public function CancelDocumentRequest(CancelDocument $request): CancelDocumentResponse
    {
        $soap = $this->getXml($this->request($request));
        $responseData = $soap->xpath('//s:Body')[0];
        $responseObj = new CancelDocumentResponse;
        $this->fillObj($responseObj, $responseData->cancelDocumentResponse->cancelDocumentResponse);

        return $responseObj;
    }
}
