<?php

namespace Reprover\Jeepay\Support;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Reprover\Jeepay\Exceptions\HttpException;
use Reprover\Jeepay\Exceptions\JeepayException;
use Reprover\Jeepay\Common\JeepayResponse;

class HttpClient
{

    use Signature;

    protected const COMMON_PREFIX = "/api";

    private Config $config;

    private array $headers = [];

    private string $baseURL = '';

    private array $fixedParams = [
        'signType' => 'MD5',
        'version'  => '1.0',
    ];

    public function __construct(Config $config)
    {
        $this->config  = $config;
        $this->baseURL = $config->getBaseURL();
    }

    /**
     * @throws HttpException
     * @throws GuzzleException
     * @throws JeepayException
     */
    public function getContent($url, $params): JeepayResponse
    {
        $data = array_merge($params, $this->fixedParams, $this->addRequiredParams());

        return $this->sendRequest('GET', $url, $data);
    }

    /**
     * @throws HttpException
     * @throws GuzzleException
     * @throws JeepayException
     */
    public function postForm($url, $data): JeepayResponse
    {
        return $this->sendRequest('POST', $url, array_merge($data, $this->fixedParams, $this->addRequiredParams()));
    }

    private function buildURL($url, $params = [])
    {
        if (count($params) > 0) {
            $url .= '?' . http_build_query($params);
        }

        return $url;
    }

    /**
     * @throws HttpException
     * @throws GuzzleException
     */
    private function sendRequest(string $method, $url, $data = []): JeepayResponse
    {
        $client = new Client([
            'base_uri' => $this->baseURL,
        ]);
        $data   = array_merge($data, ['sign' => $this->sign($data, $this->config->getKey())]);
        if ($method === 'GET') {
            $url = $this->buildURL($url, $data);
        }
        $response = $client->request($method, $url, [
            'headers'     => $this->headers,
            'form_params' => $method == 'POST' ? $data : [],
        ]);
        if ($response->getStatusCode() != 200) {
            throw new HttpException("Request failed with status code " . $response->getStatusCode());
        }

        return new JeepayResponse($response->getBody()->getContents(), $this->config->getKey());
    }

    private function addRequiredParams(): array
    {
        return [
            'mchNo'   => $this->config->getMchNo(),
            'appId'   => $this->config->getAppId(),
            'reqTime' => Carbon::now()->getTimestampMs(),
        ];
    }

}
