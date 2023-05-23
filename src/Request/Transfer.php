<?php

namespace Reprover\Jeepay\Request;

use Reprover\Jeepay\Common\JeepayResponse;
use Reprover\Jeepay\Enums\EntryType;
use Reprover\Jeepay\Enums\IfCode;
use Reprover\Jeepay\Support\HttpClient;

final class Transfer extends HttpClient
{
    const TRANSFER_PREFIX = self::COMMON_PREFIX . "/transfer";

    const TRANSFER_ORDER_URL = self::TRANSFER_PREFIX . 'Order';

    const QUERY_URL = self::TRANSFER_PREFIX . '/query';

    public function transferOrder(IfCode    $if_code,
                                  EntryType $entry_type,
                                  int       $amount,
                                  string    $account_no,
                                  ?string   $account_name = null,
                                  ?string   $bank_name = null,
                                  ?string   $client_ip = null,
                                  ?string   $transfer_desc = null,
                                  ?string   $notify_url = null,
                                  ?string   $channel_extra = null,
                                  ?string   $ext_param = null): JeepayResponse
    {
        $params = array_filter([
            'ifCode'       => $if_code->value,
            'entryType'    => $entry_type->value,
            'amount'       => $amount,
            'currency'     => 'cny',
            'accountNo'    => $account_no,
            'accountName'  => $account_name,
            'bankName'     => $bank_name,
            'clientIp'     => $client_ip,
            'transferDesc' => $transfer_desc,
            'notifyUrl'    => $notify_url,
            'channelExtra' => $channel_extra,
            'extParam'     => $ext_param,
        ], function ($value) {
            return !is_null($value);
        });

        return $this->postForm(self::TRANSFER_ORDER_URL, $params);
    }

    public function query(?string $transfer_id, ?string $mch_order_no): JeepayResponse
    {
        if (is_null($transfer_id) && is_null($mch_order_no)) {
            throw new \InvalidArgumentException('one of transferId and mchOrderNo is required');
        }
        $params = [
            'transferId' => $transfer_id,
            'mchOrderNo' => $mch_order_no,
        ];

        return $this->postForm(self::QUERY_URL, $params);
    }
}