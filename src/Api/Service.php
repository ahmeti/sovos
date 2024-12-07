<?php

namespace Ahmeti\Sovos\Api;

use Ahmeti\Sovos\Archive\CancelInvoice;
use Ahmeti\Sovos\Archive\GetInvoiceDocument;
use Ahmeti\Sovos\Archive\GetSignedInvoice;
use Ahmeti\Sovos\Archive\SendEnvelope;
use Ahmeti\Sovos\Archive\SendInvoice;
use Ahmeti\Sovos\Exceptions\GlobalException;
use Ahmeti\Sovos\Exceptions\SchemaValidationException;
use Ahmeti\Sovos\Exceptions\UnauthorizedException;
use Ahmeti\Sovos\SMM\CancelDocument;
use Ahmeti\Sovos\SMM\GetDocument;
use Ahmeti\Sovos\SMM\SendDocument;
use GuzzleHttp\Client;

class Service
{
    protected string $url_test = '';

    protected string $url_prod = '';

    protected string $url = '';

    protected array $headers = [
        'Content-Type' => 'text/xml;charset=UTF-8',
        'Accept' => 'text/xml',
        'Cache-Control' => 'no-cache',
        'Pragma' => 'no-cache',
        'Host' => '',
        'Authorization' => '',
    ];

    protected string $soapXmlPref = '';

    protected string $soapSubClassPrefix = '';

    protected Client $client;

    public function __construct(
        private string $username,
        private string $password,
        private bool $test = false,
        private bool $debug = false
    ) {
        $this->url = $test ? $this->url_test : $this->url_prod;
        $this->headers['Host'] = parse_url($this->url, PHP_URL_HOST);
        $this->headers['Authorization'] = 'Basic '.base64_encode($username.':'.$password);
        $this->client = new Client;
    }

    public function setSoapXmlPref(string $soapXmlPref): void
    {
        $this->soapXmlPref = $soapXmlPref;
    }

    public function setSoapSubClassPrefix(string $soapSubClassPrefix): void
    {
        $this->soapSubClassPrefix = $soapSubClassPrefix;
    }

    protected function request(object $request): string
    {
        $get_variables = get_object_vars($request);
        $methodName = $get_variables['methodName'];
        $soapAction = $get_variables['soapAction'];
        $prefix = $get_variables['prefix'] ?? null;
        $namespace = $get_variables['namespace'] ?? null;
        unset($get_variables['methodName']);
        unset($get_variables['soapAction']);
        unset($get_variables['prefix']);
        unset($get_variables['namespace']);
        $xmlMake = $this->makeXml($methodName, $get_variables, $prefix, $namespace);

        if (get_class($request) == CancelInvoice::class) {
            $xmlMake = str_replace(['get:', ':get'], ['inv:', ':inv'], $xmlMake);
        }
        if (get_class($request) === SendInvoice::class) {
            $xmlMake = str_replace(['get:', ':get'], ['inv:', ':inv'], $xmlMake);
        }
        if (get_class($request) === SendEnvelope::class) {
            $xmlMake = str_replace(['get:', ':get'], ['inv:', ':inv'], $xmlMake);
        }
        if (get_class($request) === GetInvoiceDocument::class) {
            $xmlMake = str_replace(['get:', 'xmlns:get'], ['inv:', 'xmlns:inv'], $xmlMake);
        }
        if (get_class($request) === GetSignedInvoice::class) {
            $xmlMake = str_replace(['get:', 'xmlns:get'], ['inv:', 'xmlns:inv'], $xmlMake);
        }

        if (get_class($request) == CancelDocument::class) {
            $xmlMake = str_replace(['get:', ':get'], ['esmm:', ':esmm'], $xmlMake);
        }
        if (get_class($request) == SendDocument::class) {
            $xmlMake = str_replace(['get:', ':get'], ['esmm:', ':esmm'], $xmlMake);
        }
        if (get_class($request) == GetDocument::class) {
            $xmlMake = str_replace(['get:', ':get'], ['esmm:', ':esmm'], $xmlMake);
        }

        if ($this->debug) {
            throw new GlobalException($xmlMake);
        }

        $this->headers['SOAPAction'] = $soapAction;
        $this->headers['Content-Length'] = strlen($xmlMake);
        $response = $this->client->request('POST', $this->url, [
            'headers' => $this->headers,
            'body' => $xmlMake,
            'http_errors' => false,
            'verify' => false,
        ]);

        return $response->getBody()->getContents();
    }

    protected function fillObj(object $object, object $data): object
    {
        $vars = get_object_vars($object);
        foreach ($vars as $key => $val) {
            $object->{$key} = (string) $data->{$key};
        }

        return $object;
    }

    protected function xml2array(object $xmlObject, array &$out = []): array
    {
        foreach ((array) $xmlObject as $index => $node) {
            $out[$index] = (is_object($node)) ? $this->xml2array($node) : $node;
        }

        return $out;
    }

    protected function makeSubXml(array|object $variables, string &$subXml, ?string $prefix = null, ?string $namespace = null): void
    {
        foreach ($variables as $key => $val) {
            if (is_object($val)) {
                $this->makeSubXml($val, $subXml, $prefix, $namespace);
            } elseif (is_array($val)) {
                $this->makeSubXml($val, $subXml, $prefix, $namespace);
            } else {
                if (strlen($val) > 0) {
                    $subXml .= '<'.($prefix ? $this->soapSubClassPrefix.':' : '').$key.'>'.$val.'</'.($prefix ? $this->soapSubClassPrefix.':' : '').$key.'>';
                }
            }
        }
    }

    protected function makeXml(string $methodName, array $variables, ?string $prefix = null, ?string $namespace = null): string
    {
        $subXml = '';
        foreach ($variables as $key => $val) {
            if (is_array($val)) {
                foreach ($val as $v) {
                    if (is_object($v)) {
                        $get_variables = get_object_vars($v);
                        $subXml .= '<'.$this->soapSubClassPrefix.':'.$key.'>';
                        foreach ($get_variables as $mainKey => $variable) {
                            if (strlen($variable) > 0) {
                                $subXml .= '<'.$this->soapSubClassPrefix.':'.$mainKey.'>'.$variable.'</'.$this->soapSubClassPrefix.':'.$mainKey.'>';
                            }
                        }
                        $subXml .= '</'.$this->soapSubClassPrefix.':'.$key.'>';
                    } else {
                        if (strlen($v) > 0) {
                            $subXml .= '<'.$this->soapSubClassPrefix.':'.$key.'>'.$v.'</'.$this->soapSubClassPrefix.':'.$key.'>';
                        }
                    }
                }
            } else {
                if (strlen($val) > 0) {
                    $subXml .= '<'.$this->soapSubClassPrefix.':'.$key.'>'.$val.'</'.$this->soapSubClassPrefix.':'.$key.'>';
                }
            }
        }

        $treeXml = '<'.$this->soapSubClassPrefix.':'.$methodName.'>'.$subXml.'</'.$this->soapSubClassPrefix.':'.$methodName.'>';
        $mainXml = sprintf($this->soapXmlPref, $treeXml);

        return trim($mainXml);
    }

    protected function getXml(string $responseText): object
    {
        $soap = simplexml_load_string($responseText);
        $soap->registerXPathNamespace('s', 'http://schemas.xmlsoap.org/soap/envelope/');
        if (isset($soap->xpath('//s:Body/s:Fault')[0])) {
            $fault = $soap->xpath('//s:Body/s:Fault')[0];

            if ($fault->faultstring == 'Unauthorized') {
                throw new UnauthorizedException($fault->faultstring, (int) $fault->faultcode);
            } elseif ($fault->faultstring == 'Şema validasyon hatası') {
                $message = $soap->xpath('//s:Body/s:Fault/detail');
                if (isset($message[0])) {
                    throw new SchemaValidationException($message[0]->ProcessingFault->Message, (int) $message[0]->ProcessingFault->Code);
                } else {
                    throw new SchemaValidationException('Bilinmeyen bir şema hatası oluştu.');
                }
            } elseif ($fault->faultcode == 's:Server') {
                $message = $soap->xpath('//s:Body/s:Fault/detail');

                if (isset($message[0])) {
                    $fault->faultstring = $message[0]->ProcessingFault->Message;
                    $fault->faultcode = $message[0]->ProcessingFault->Code;
                }
                if ($fault->faultcode == 's:Server') {
                    $fault->faulcode = 0;
                }
                throw new GlobalException($fault->faultstring, (int) $fault->faultcode);
            } else {
                throw new GlobalException("Fatal Error : Code '".$fault->faultcode."', Message '".$fault->faultstring."' [".$responseText.'].');
            }
        }

        return $soap;
    }
}
