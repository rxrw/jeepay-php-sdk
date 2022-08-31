<?php

namespace Reprover\Jeepay\Request;

class RefundOrderRequest extends BaseRequest
{

    private string $mch_order_no;

    private string $pay_order_id;

    private int $refund_amount;

    private string $currency;

    private string $refund_reason;

    private string $mch_refund_no;

    private string $refund_notify_url;

    private string $ext_param;

    private string $client_ip;

    private string $channel_extra;


    public function rules(): array
    {
        return [
            'mch_order_no' => 'required|string',
            'pay_order_id' => 'required|string',
            'mch_refund_no' => 'required|string',
            'refund_amount' => 'required|int',
            'currency' => 'required|string',
            'refund_reason' => 'required|string',
            'client_ip' => 'nullable|ipv4',
            'notify_url' => 'nullable|url',
            'channel_extra' => 'nullable|json',
            'ext_param' => 'nullable|string',
        ];
    }

    /**
     * @return string
     */
    public function getMchOrderNo(): string
    {
        return $this->mch_order_no;
    }

    /**
     * @param string $mch_order_no
     */
    public function setMchOrderNo(string $mch_order_no): void
    {
        $this->mch_order_no = $mch_order_no;
    }

    /**
     * @return string
     */
    public function getPayOrderId(): string
    {
        return $this->pay_order_id;
    }

    /**
     * @param string $pay_order_id
     */
    public function setPayOrderId(string $pay_order_id): void
    {
        $this->pay_order_id = $pay_order_id;
    }

    /**
     * @return int
     */
    public function getRefundAmount(): int
    {
        return $this->refund_amount;
    }

    /**
     * @param int $refund_amount
     */
    public function setRefundAmount(int $refund_amount): void
    {
        $this->refund_amount = $refund_amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getRefundReason(): string
    {
        return $this->refund_reason;
    }

    /**
     * @param string $refund_reason
     */
    public function setRefundReason(string $refund_reason): void
    {
        $this->refund_reason = $refund_reason;
    }

    /**
     * @return string
     */
    public function getMchRefundNo(): string
    {
        return $this->mch_refund_no;
    }

    /**
     * @param string $mch_refund_no
     */
    public function setMchRefundNo(string $mch_refund_no): void
    {
        $this->mch_refund_no = $mch_refund_no;
    }

    /**
     * @return string
     */
    public function getRefundNotifyUrl(): string
    {
        return $this->refund_notify_url;
    }

    /**
     * @param string $refund_notify_url
     */
    public function setRefundNotifyUrl(string $refund_notify_url): void
    {
        $this->refund_notify_url = $refund_notify_url;
    }

    /**
     * @return string
     */
    public function getExtParam(): string
    {
        return $this->ext_param;
    }

    /**
     * @param string $ext_param
     */
    public function setExtParam(string $ext_param): void
    {
        $this->ext_param = $ext_param;
    }

    /**
     * @return string
     */
    public function getClientIp(): string
    {
        return $this->client_ip;
    }

    /**
     * @param string $client_ip
     */
    public function setClientIp(string $client_ip): void
    {
        $this->client_ip = $client_ip;
    }

    /**
     * @return string
     */
    public function getChannelExtra(): string
    {
        return $this->channel_extra;
    }

    /**
     * @param string $channel_extra
     */
    public function setChannelExtra(string $channel_extra): void
    {
        $this->channel_extra = $channel_extra;
    }
}