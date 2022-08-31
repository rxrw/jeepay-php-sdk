<?php

namespace Services;

use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use Reprover\Jeepay\Common\Config;
use Reprover\Jeepay\Constants\WayCode;
use Reprover\Jeepay\Exceptions\HttpException;
use Reprover\Jeepay\Request\QueryOrderRequest;
use Reprover\Jeepay\Request\UnifiedOrderRequest;
use Reprover\Jeepay\Services\Pay;

class PayTest extends TestCase
{

    private array $config = [
        'key' => 'testkey',
        'base_url' => 'https://pay.example.com',
        'mch_no' => 'M123456789',
        'app_id' => 'appid',
    ];

    /**
     * @throws HttpException
     * @throws GuzzleException
     */
    public function testUnifiedOrder()
    {
        $config = new Config($this->config);
        $pay = new Pay($config);
        $request = new UnifiedOrderRequest($config);
        $request->setAttribute([
            'mch_order_no' => '12345678902',
            'way_code' => WayCode::WX_NATIVE,
            'amount' => 100,
            'currency' => 'CNY',
            'subject' => 'test',
            'body' => 'test',
            'client_ip' => '',]);
        $pay->unifiedOrder($request);
    }

    public function testQueryOrder()
    {
        $config = new Config($this->config);
        $pay = new Pay($config);
        $request = new QueryOrderRequest($config);
        $request->setAttribute([
            'mch_order_no' => '1234567890',
        ]);
        $pay->queryOrder($request);
    }
}