<?php

namespace Reprover\Jeepay\Services;

use Reprover\Jeepay\Common\Config;
use Reprover\Jeepay\Common\HttpClient;
use Reprover\Jeepay\Common\ValidatorFactory;
use Reprover\Jeepay\Request\RefundOrderRequest;
use Reprover\Jeepay\Response\RefundOrderResponse;

class Refund
{
    const REFUND_ORDER_URL = '/api/refund/refundOrder';

    const QUERY_URL = '/api/refund/query';

    private HttpClient $client;

    public function __construct(Config $config)
    {
        $this->client = new HttpClient($config);
    }

    public function refundOrder(RefundOrderRequest $request): RefundOrderResponse
    {
        $data = (new ValidatorFactory())->validate($request);
        return $this->client->postForm(self::REFUND_ORDER_URL, $data, RefundOrderResponse::class);
    }

}