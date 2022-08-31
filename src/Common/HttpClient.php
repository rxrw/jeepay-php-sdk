<?php

namespace Reprover\Jeepay\Common;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Reprover\Jeepay\Exceptions\HttpException;
use Reprover\Jeepay\Exceptions\JeepayException;
use Reprover\Jeepay\Response\BaseResponse;

class HttpClient
{

    use Signature;

    private Config $config;

    private array $headers = [];

    private string $baseURL = '';

    private array $fixedParams = [
        'signType' => 'MD5',
        'version' => '1.0'
    ];

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->baseURL = $config->getBaseURL();
    }

    /**
     * @throws HttpException
     * @throws GuzzleException
     * @throws JeepayException
     */
    public function getContent($url, $params, $response_type): BaseResponse
    {
        $data = array_merge($params, $this->fixedParams, $this->addRequiredParams());
        $response = $this->sendRequest('GET', $url, $data);
        return $this->parseResponse($response, $response_type);
    }

    /**
     * @throws HttpException
     * @throws GuzzleException
     * @throws JeepayException
     */
    public function postForm($url, $data, $response_type): BaseResponse
    {
        $response = $this->sendRequest('POST', $url, array_merge($data, $this->fixedParams, $this->addRequiredParams()));
        return $this->parseResponse($response, $response_type);
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
    private function sendRequest(string $method, $url, $data = []): string
    {
        $client = new Client([
            'base_uri' => $this->baseURL,
        ]);
        $data = $this->convertToCamel($data);
        $data = array_merge($data, ['sign' => $this->sign($data, $this->config->getKey())]);
        if ($method === 'GET') {
            $url = $this->buildURL($url, $data);
        }
        $response = $client->request($method, $url, [
            'headers' => $this->headers,
            'form_params' => $method == 'POST' ? $data : [],
        ]);
        if ($response->getStatusCode() != 200) {
            throw new HttpException("Request failed with status code " . $response->getStatusCode());
        }
        return $response->getBody()->getContents();
    }

    /**
     * @throws JeepayException
     */
    private function parseResponse($response, $response_type): BaseResponse
    {
        $response = json_decode($response, true);
        if (is_null($response)) {
            throw new JeepayException('Invalid response');
        }
        $response = $this->convertToSnake($response);
        return new $response_type($response, $this->config->getKey());
    }

    private function addRequiredParams(): array
    {
        return [
            'mchNo' => $this->config->getMchNo(),
            'appId' => $this->config->getAppId(),
            'reqTime' => Carbon::now()->getTimestampMs(),
        ];
    }

    private function convertToCamel($data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            $result[Str::camel($key)] = $value;
        }
        return $result;
    }

    private function convertToSnake($data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            $result[Str::snake($key)] = $value;
        }
        return $result;
    }

}