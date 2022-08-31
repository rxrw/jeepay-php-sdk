<?php

namespace Reprover\Jeepay\Request;

class UnifiedOrderRequest extends BaseRequest
{
    private string $mch_order_no;

    private string $way_code;

    private int $amount;

    private string $currency;

    private string $client_ip;

    private string $subject;

    private string $body;

    private string $notify_url;

    private string $return_url;

    private int $expired_time;

    private string $channel_extra;

    private int $division_mode;

    private string $ext_param;


    public function rules(): array
    {
        return [
            'mch_order_no' => 'required|string',
            'way_code' => 'required|string',
            'amount' => 'required|integer',
            'currency' => 'required|string:3',
            'client_ip' => 'nullable|ipv4',
            'subject' => 'required|string',
            'body' => 'required|string',
            'notify_url' => 'nullable|url',
            'return_url' => 'nullable|url',
            'expired_time' => 'nullable|integer',
            'channel_extra' => 'nullable|json',
            'division_mode' => 'nullable|integer|in:0,1,2',
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
    public function getWayCode(): string
    {
        return $this->way_code;
    }

    /**
     * @param string $way_code
     */
    public function setWayCode(string $way_code): void
    {
        $this->way_code = $way_code;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
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
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getNotifyUrl(): string
    {
        return $this->notify_url;
    }

    /**
     * @param string $notify_url
     */
    public function setNotifyUrl(string $notify_url): void
    {
        $this->notify_url = $notify_url;
    }

    /**
     * @return string
     */
    public function getReturnUrl(): string
    {
        return $this->return_url;
    }

    /**
     * @param string $return_url
     */
    public function setReturnUrl(string $return_url): void
    {
        $this->return_url = $return_url;
    }

    /**
     * @return int
     */
    public function getExpiredTime(): int
    {
        return $this->expired_time;
    }

    /**
     * @param int $expired_time
     */
    public function setExpiredTime(int $expired_time): void
    {
        $this->expired_time = $expired_time;
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

    /**
     * @return int
     */
    public function getDivisionMode(): int
    {
        return $this->division_mode;
    }

    /**
     * @param int $division_mode
     */
    public function setDivisionMode(int $division_mode): void
    {
        $this->division_mode = $division_mode;
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
}