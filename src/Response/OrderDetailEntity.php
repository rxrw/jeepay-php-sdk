<?php

namespace Reprover\Jeepay\Response;

use Carbon\Carbon;

class OrderDetailEntity extends BaseResponse
{

    private string $pay_order_id;

    private string $mch_order_no;

    private string $mch_no;

    private string $app_id;

    private string $if_code;

    private string $way_code;

    private string $amount;

    private string $currency;

    private int $state;

    private string $client_ip;

    private string $subject;

    private string $body;

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
        $this->pay_order_id = $data['payOrderId'];
        $this->mch_order_no = $data['mchOrderNo'];
        $this->mch_no = $data['mchNo'];
        $this->app_id = $data['appId'];
        $this->if_code = $data['ifCode'];
        $this->way_code = $data['wayCode'];
        $this->amount = $data['amount'];
        $this->currency = $data['currency'];
        $this->state = $data['state'];
        if (isset($data['clientIp'])) {
            $this->client_ip = $data['clientIp'];
        }
        $this->subject = $data['subject'];
        $this->body = $data['body'];
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
    public function getPayOrderId(): string
    {
        return $this->pay_order_id;
    }

    /**
     * @return string
     */
    public function getMchOrderNo(): string
    {
        return $this->mch_order_no;
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
    public function getIfCode(): string
    {
        return $this->if_code;
    }

    /**
     * @return string
     */
    public function getWayCode(): string
    {
        return $this->way_code;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
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
    public function getClientIp(): string
    {
        return $this->client_ip;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
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