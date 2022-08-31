<?php

namespace Reprover\Jeepay\Services;

use GuzzleHttp\Exception\GuzzleException;
use Reprover\Jeepay\Common\Config;
use Reprover\Jeepay\Common\HttpClient;
use Reprover\Jeepay\Common\ValidatorFactory;
use Reprover\Jeepay\Exceptions\HttpException;
use Reprover\Jeepay\Exceptions\JeepayException;
use Reprover\Jeepay\Request\CloseOrderRequest;
use Reprover\Jeepay\Request\QueryOrderRequest;
use Reprover\Jeepay\Request\UnifiedOrderRequest;
use Reprover\Jeepay\Response\CloseOrderResponse;
use Reprover\Jeepay\Response\OrderDetailEntity;
use Reprover\Jeepay\Response\UnifiedOrderResponse;

class Pay
{
    const UNIFIED_ORDER_URL = '/api/pay/unifiedOrder';

    const QUERY_URL = '/api/pay/query';

    const CLOSE_URL = '/api/pay/close';

    const CHANNEL_USER_ID = '/api/channelUserId/jump';

    private HttpClient $client;

    public function __construct(Config $config)
    {
        $this->client = new HttpClient($config);
    }

    /**
     * @throws HttpException
     * @throws GuzzleException
     * @throws JeepayException
     */
    public function unifiedOrder(UnifiedOrderRequest $request): UnifiedOrderResponse
    {
        $data = (new ValidatorFactory())->validate($request);
        return $this->client->postForm(self::UNIFIED_ORDER_URL, $data, UnifiedOrderResponse::class);
    }

    /**
     * @throws HttpException
     * @throws GuzzleException
     * @throws JeepayException
     */
    public function queryOrder(QueryOrderRequest $request): OrderDetailEntity
    {
        $data = (new ValidatorFactory())->validate($request);
        return $this->client->getContent(self::QUERY_URL, $data, OrderDetailEntity::class);
    }

    /**
     * @throws HttpException
     * @throws GuzzleException
     * @throws JeepayException
     */
    public function closeOrder(CloseOrderRequest $request): CloseOrderResponse
    {
        $data = (new ValidatorFactory())->validate($request);
        return $this->client->getContent(self::QUERY_URL, $data, CloseOrderResponse::class);
    }


}