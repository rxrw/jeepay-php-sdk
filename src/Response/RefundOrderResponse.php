<?php

namespace Reprover\Jeepay\Response;

class RefundOrderResponse extends BaseResponse
{

    private string $refund_order_id;

    private string $mch_refund_no;

    private int $state;

    private string $channel_order_no;

    private string $err_code;

    private string $err_msg;

    public function __construct($response, string $key)
    {
        parent::__construct($response, $key);
        $data = $this->getData();
        $this->refund_order_id = $data['refund_order_id'];
        $this->mch_refund_no = $data['mch_refund_no'];
        $this->state = $data['state'];
        if (isset($data['channel_order_no'])) {
            $this->channel_order_no = $data['channel_order_no'];
        }
        if (isset($data['err_code'])) {
            $this->err_code = $data['err_code'];
        }
        if (isset($data['err_msg'])) {
            $this->err_msg = $data['err_msg'];
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
    public function getMchRefundNo(): string
    {
        return $this->mch_refund_no;
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
}