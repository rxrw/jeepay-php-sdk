<?php

namespace Reprover\Jeepay\Response;

class CloseOrderResponse extends BaseResponse
{
    private string $err_code;

    private string $err_msg;

    public function __construct($response, string $key)
    {
        parent::__construct($response, $key);

        $response = $this->getData();

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