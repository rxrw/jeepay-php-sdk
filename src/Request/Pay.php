<?php

namespace Reprover\Jeepay\Request;

use Reprover\Jeepay\caseants\WayCode;
use Reprover\Jeepay\Common\JeepayResponse;
use Reprover\Jeepay\Enums\DivisionMode;
use Reprover\Jeepay\Support\HttpClient;

final class Pay extends HttpClient
{

    const PAY_URL = self::COMMON_PREFIX . "/pay";

    const UNIFIED_ORDER_URL = self::PAY_URL . '/unifiedOrder';

    const QUERY_URL = self::PAY_URL . '/query';

    const CLOSE_URL = self::PAY_URL . '/close';

    /**
     * @throws \Reprover\Jeepay\Exceptions\JeepayException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Reprover\Jeepay\Exceptions\HttpException
     */
    public function unifiedOrder(string       $mch_order_no,
                                 WayCode      $way_code,
                                 int          $amount,
                                 string       $subject,
                                 string       $body,
                                 array        $channel_extra = [],
                                 ?string      $notify_url = null,
                                 ?string      $return_url = null,
                                 ?int         $expired_time = null,
                                 ?string      $client_ip = null,
                                 ?string      $ext_param = null,
                                 DivisionMode $division_mode = DivisionMode::AUTO): JeepayResponse
    {
        // convert all params into camel case, ignore null value
        $params = array_filter([
            'mchOrderNo'   => $mch_order_no,
            'wayCode'      => $way_code->value,
            'amount'       => $amount,
            'currency'     => 'cny',
            'subject'      => $subject,
            'body'         => $body,
            'notifyUrl'    => $notify_url,
            'returnUrl'    => $return_url,
            'expiredTime'  => $expired_time,
            'channelExtra' => $channel_extra,
            'clientIp'     => $client_ip,
            'divisionMode' => $division_mode->value,
            'extParam'     => $ext_param,
        ], function ($value) {
            return !is_null($value);
        });

        return $this->postForm(self::UNIFIED_ORDER_URL, $params);
    }

    public function query(?string $pay_order_id, ?string $mch_order_no): JeepayResponse
    {
        if (is_null($pay_order_id) && is_null($mch_order_no)) {
            throw new \InvalidArgumentException('one of payOrderId and mchOrderNo is required');
        }
        $params = array_filter([
            'payOrderId' => $pay_order_id,
            'mchOrderNo' => $mch_order_no,
        ], function ($value) {
            return !is_null($value);
        });

        return $this->postForm(self::QUERY_URL, $params);
    }

    public function close(?string $pay_order_id, ?string $mch_order_no): JeepayResponse
    {
        // one of payOrderId and mchOrderNo is required
        if (is_null($pay_order_id) && is_null($mch_order_no)) {
            throw new \InvalidArgumentException('one of payOrderId and mchOrderNo is required');
        }
        $params = array_filter([
            'payOrderId' => $pay_order_id,
            'mchOrderNo' => $mch_order_no,
        ], function ($value) {
            return !is_null($value);
        });

        return $this->postForm(self::CLOSE_URL, $params);
    }

}
