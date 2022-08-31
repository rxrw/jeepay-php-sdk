<?php

namespace Reprover\Jeepay\Response;

use Carbon\Carbon;

class RefundDetailEntity extends BaseResponse
{
    private string $refund_order_id;
    private string $pay_order_id;
    private string $mch_refund_no;
    private string $mch_no;
    private string $app_id;
    private string $pay_amount;
    private string $refund_amount;
    private string $currency;
    private int $state;
    private string $channel_order_no;
    private string $err_code;
    private string $err_msg;
    private string $ext_param;
    private Carbon $created_at;
    private Carbon $success_at;


    public function __construct($response, string $key)
    {
        parent::__construct($response, $key);

        $data = $this->getData();
        $this->refund_order_id = $data['refundOrderId'];
        $this->pay_order_id = $data['payOrderId'];
        $this->mch_refund_no = $data['mchRefundNo'];
        $this->mch_no = $data['mchNo'];
        $this->app_id = $data['appId'];
        $this->pay_amount = $data['payAmount'];
        $this->refund_amount = $data['refundAmount'];
        $this->currency = $data['currency'];
        $this->state = $data['state'];
        if (isset($data['channelOrderNo'])) {
            $this->channel_order_no = $data['channelOrderNo'];
        }
        if (isset($data['errCode'])) {
            $this->err_code = $data['errCode'];
        }
        if (isset($data['errMsg'])) {
            $this->err_msg = $data['errMsg'];
        }
        if (isset($data['extParam'])) {
            $this->ext_param = $data['extParam'];
        }
        $this->created_at = Carbon::createFromTimestampMs($data['createdAt']);
        if (isset($data['successAt'])) {
            $this->success_at = Carbon::createFromTimestampMs($data['successAt']);
        }
    }

    /**
     * @return string
     */
    public function getRefundOrderId(): string
    {
        return $this->refund_order_id;
    }

    /**
     * @return string
     */
    public function getPayOrderId(): string
    {
        return $this->pay_order_id;
    }

    /**
     * @return string
     */
    public function getMchRefundNo(): string
    {
        return $this->mch_refund_no;
    }

    /**
     * @return string
     */
    public function getMchNo(): string
    {
        return $this->mch_no;
    }

    /**
     * @return string
     */
    public function getAppId(): string
    {
        return $this->app_id;
    }

    /**
     * @return string
     */
    public function getPayAmount(): string
    {
        return $this->pay_amount;
    }

    /**
     * @return string
     */
    public function getRefundAmount(): string
    {
        return $this->refund_amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getChannelOrderNo(): string
    {
        return $this->channel_order_no;
    }

    /**
     * @return string
     */
    public function getErrCode(): string
    {
        return $this->err_code;
    }

    /**
     * @return string
     */
    public function getErrMsg(): string
    {
        return $this->err_msg;
    }

    /**
     * @return string
     */
    public function getExtParam(): string
    {
        return $this->ext_param;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    /**
     * @return Carbon
     */
    public function getSuccessAt(): Carbon
    {
        return $this->success_at;
    }
}