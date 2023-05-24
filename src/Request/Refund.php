<?php

namespace Reprover\Jeepay\Request;

use Reprover\Jeepay\Common\JeepayResponse;
use Reprover\Jeepay\Support\HttpClient;

final class Refund extends HttpClient
{

    const REFUND_PREFIX    = self::COMMON_PREFIX . "/refund";
    const REFUND_ORDER_URL = self::REFUND_PREFIX . '/refundOrder';

    const QUERY_URL = self::REFUND_PREFIX . '/query';

    /**
     * @param string|null $pay_order_id
     * @param string|null $mch_order_no
     * @param string      $mch_refund_no
     * @param int         $refund_amount
     * @param string      $refund_reason
     * @param array       $channel_extra
     * @param string|null $notify_url
     * @param string|null $client_ip
     * @param string|null $ext_param
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Reprover\Jeepay\Exceptions\HttpException
     * @throws \Reprover\Jeepay\Exceptions\JeepayException
     * @return array{
     *      channelOrderNo: string,
     *      mchRefundNo: string,
     *      payAmount: int,
     *      refundAmount: int,
     *      refundOrderId: string,
     *      state: int,
     *  }
     */
    public function refundOrder(?string $pay_order_id,
                                ?string $mch_order_no,
                                string  $mch_refund_no,
                                int     $refund_amount,
                                string  $refund_reason,
                                array   $channel_extra = [],
                                ?string $notify_url = null,
                                ?string $client_ip = null,
                                ?string $ext_param = null): array
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

        return $this->postForm(self::REFUND_ORDER_URL, $params)->toArray();
    }

    /**
     * @param string|null $refund_order_id
     * @param string|null $mch_refund_no
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Reprover\Jeepay\Exceptions\HttpException
     * @throws \Reprover\Jeepay\Exceptions\JeepayException
     * @return array{
     *     appId: string,
     *     channelOrderNo: string,
     *     createdAt: int,
     *     currency: string,
     *     extParam: string,
     *     mchNo: string,
     *     mchRefundNo: string,
     *     payAmount: int,
     *     payOrderId: string,
     *     refundAmount: int,
     *     refundOrderId: string,
     *     state: int,
     *     successTime: int,
     *     errCode: string,
     *     errMsg: string,
     * }
     */
    public function query(?string $refund_order_id, ?string $mch_refund_no): array
    {
        if (is_null($refund_order_id) && is_null($mch_refund_no)) {
            throw new \InvalidArgumentException('one of refundOrderId and mchRefundNo is required');
        }
        $params = [
            'refundOrderId' => $refund_order_id,
            'mchRefundNo'   => $mch_refund_no,
        ];

        return $this->postForm(self::QUERY_URL, $params)->toArray();
    }
}