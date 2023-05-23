<?php

namespace Reprover\Jeepay\Request;

use Reprover\Jeepay\Common\JeepayResponse;
use Reprover\Jeepay\Support\HttpClient;

final class Refund extends HttpClient
{

    const REFUND_PREFIX    = self::COMMON_PREFIX . "/refund";
    const REFUND_ORDER_URL = self::REFUND_PREFIX . '/refundOrder';

    const QUERY_URL = self::REFUND_PREFIX . '/query';

    public function refundOrder(?string $pay_order_id,
                                ?string $mch_order_no,
                                string  $mch_refund_no,
                                int     $refund_amount,
                                string  $refund_reason,
                                array   $channel_extra = [],
                                ?string $notify_url = null,
                                ?string $client_ip = null,
                                ?string $ext_param = null): JeepayResponse
    {
        if (is_null($pay_order_id) && is_null($mch_order_no)) {
            throw new \InvalidArgumentException('one of payOrderId and mchOrderNo is required');
        }

        $params = array_filter([
            'payOrderId'   => $pay_order_id,
            'mchOrderNo'   => $mch_order_no,
            'mchRefundNo'  => $mch_refund_no,
            'refundAmount' => $refund_amount,
            'currency'     => 'cny',
            'refundReason' => $refund_reason,
            'channelExtra' => $channel_extra,
            'notifyUrl'    => $notify_url,
            'clientIp'     => $client_ip,
            'extParam'     => $ext_param,
        ], function ($value) {
            return !is_null($value);
        });

        return $this->postForm(self::REFUND_ORDER_URL, $params);
    }

    public function query(?string $refund_order_id, ?string $mch_refund_no): JeepayResponse
    {
        if (is_null($refund_order_id) && is_null($mch_refund_no)) {
            throw new \InvalidArgumentException('one of refundOrderId and mchRefundNo is required');
        }
        $params = [
            'refundOrderId' => $refund_order_id,
            'mchRefundNo'   => $mch_refund_no,
        ];

        return $this->postForm(self::QUERY_URL, $params);
    }
}