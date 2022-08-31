<?php

namespace Reprover\Jeepay\Response;

class UnifiedOrderResponse extends BaseResponse
{
    private string $mch_order_no;

    private string $pay_order_id;

    private int $order_state;

    private string $pay_data_type;

    private string $pay_data;

    private string $err_code;

    private string $err_msg;

    public function __construct($response, string $key)
    {
        parent::__construct($response, $key);

        $response = $this->getData();
        $this->mch_order_no = $response['mchOrderNo'];
        $this->pay_order_id = $response['payOrderId'];
        $this->order_state = $response['orderState'];

        if (isset($response['payDataType'])) {
            $this->pay_data_type = $response['payDataType'];
        }
        if (isset($response['payData'])) {
            $this->pay_data = $response['payData'];
        }
        if (isset($response['errCode'])) {
            $this->err_code = $response['errCode'];
        }
        if (isset($response['errMsg'])) {
            $this->err_msg = $response['errMsg'];
        }
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
    public function getPayOrderId(): string
    {
        return $this->pay_order_id;
    }

    /**
     * @return int
     */
    public function getOrderState(): int
    {
        return $this->order_state;
    }

    /**
     * @return string
     */
    public function getPayDataType(): string
    {
        return $this->pay_data_type;
    }

    /**
     * @return string
     */
    public function getPayData(): string
    {
        return $this->pay_data;
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