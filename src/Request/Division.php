<?php

namespace Reprover\Jeepay\Request;

use Reprover\Jeepay\Enums\AccountType;
use Reprover\Jeepay\Enums\DivisionRelationType;
use Reprover\Jeepay\Enums\IfCode;
use Reprover\Jeepay\Support\HttpClient;

final class Division extends HttpClient
{
    const DIVISION_PREFIX = self::COMMON_PREFIX . '/division';
    const DIVISION_BIND   = self::DIVISION_PREFIX . '/receiver/bind';
    const DIVISION_EXEC   = self::DIVISION_PREFIX . '/exec';

    /**
     * @param \Reprover\Jeepay\Enums\IfCode               $if_code
     * @param string                                      $receiver_alias
     * @param int                                         $receiver_group_id
     * @param \Reprover\Jeepay\Enums\AccountType          $acc_type
     * @param string                                      $acc_no
     * @param string|null                                 $acc_name
     * @param \Reprover\Jeepay\Enums\DivisionRelationType $relation_type
     * @param string|null                                 $relation_type_name
     * @param string|null                                 $channel_ext_info
     * @param string                                      $division_profit
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Reprover\Jeepay\Exceptions\HttpException
     * @throws \Reprover\Jeepay\Exceptions\JeepayException
     * @return array{
     *     accName: string,
     *     accNo: string,
     *     accType: int,
     *     appId: string,
     *     bindState: int,
     *     divisionProfit: string,
     *     errCode: string,
     *     errMsg: string,
     *     ifCode: string,
     *     mchNo: string,
     *     receiverAlias: string,
     *     receiverGroupId: int,
     *     relationType: string,
     *     relationTypeName: string
     *     }
     */
    public function bind(IfCode $if_code, string $receiver_alias, int $receiver_group_id, AccountType $acc_type, string $acc_no, ?string $acc_name, DivisionRelationType $relation_type, ?string $relation_type_name, ?string $channel_ext_info, string $division_profit): array
    {
        $params = [
            'if_code'            => $if_code->value,
            'receiver_alias'     => $receiver_alias,
            'receiver_group_id'  => $receiver_group_id,
            'acc_type'           => $acc_type->value,
            'acc_no'             => $acc_no,
            'acc_name'           => $acc_name,
            'relation_type'      => $relation_type->value,
            'relation_type_name' => $relation_type_name,
            'channel_ext_info'   => $channel_ext_info,
            'division_profit'    => $division_profit,
        ];

        return $this->postForm(self::DIVISION_BIND, $params)->toArray();
    }

    /**
     * @param string|null $pay_order_id
     * @param string|null $mch_order_no
     * @param bool        $use_sys_auto_division_receivers
     * @param array<int, array{
     *      receiverId: ?int,
     *      receiverGroupId: ?int,
     *      divisionProfit: ?string,
     *     }>             $receivers
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Reprover\Jeepay\Exceptions\HttpException
     * @throws \Reprover\Jeepay\Exceptions\JeepayException
     * @return array{
     *     channelBatchOrderId: string,
     *     errCode: string,
     *     errMsg: string,
     *     state: int
     * }
     */
    public function exec(?string $pay_order_id, ?string $mch_order_no, bool $use_sys_auto_division_receivers, ?array $receivers = []): array
    {
        if ($pay_order_id === null && $mch_order_no === null) {
            throw new \InvalidArgumentException('pay_order_id and mch_order_no cannot be null at the same time.');
        }

        if ($use_sys_auto_division_receivers) {
            $params = [
                'pay_order_id'                    => $pay_order_id,
                'mch_order_no'                    => $mch_order_no,
                'use_sys_auto_division_receivers' => 1,
            ];
        } else {
            $params = [
                'pay_order_id'                    => $pay_order_id,
                'mch_order_no'                    => $mch_order_no,
                'use_sys_auto_division_receivers' => 0,
                'receivers'                       => $receivers,
            ];
        }

        return $this->postForm(self::DIVISION_EXEC, $params)->toArray();
    }
}