<?php

namespace Reprover\Jeepay\Services;

use Reprover\Jeepay\Common\Config;
use Reprover\Jeepay\Common\Signature;
use Reprover\Jeepay\Common\ValidatorFactory;
use Reprover\Jeepay\Entities\PaymentNotifyEntity;
use Reprover\Jeepay\Exceptions\HttpException;
use Reprover\Jeepay\Exceptions\JeepayException;
use Reprover\Jeepay\Request\RefundOrderRequest;
use Reprover\Jeepay\Response\OrderDetailEntity;
use Reprover\Jeepay\Response\RefundDetailEntity;

class Notify
{

    use Signature;

    private Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @throws JeepayException
     * @throws HttpException
     */
    public function processPayment(array $input): OrderDetailEntity
    {
        return new OrderDetailEntity($input, $this->config->getKey(), false);
    }

    /**
     * @throws JeepayException
     * @throws HttpException
     */
    public function processRefund(array $input): RefundDetailEntity
    {
        return new RefundDetailEntity($input, $this->config->getKey(), false);
    }

    public function success()
    {
        return "success";
    }
}