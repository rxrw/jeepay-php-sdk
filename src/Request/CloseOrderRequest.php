<?php

namespace Reprover\Jeepay\Request;

class CloseOrderRequest extends BaseRequest
{

    private string $mch_order_no;

    private string $pay_order_id;

    public function rules(): array
    {
        return [
            'mch_order_no' => 'nullable|string',
            'pay_order_id' => 'required_without:mch_order_no|string',
        ];
    }
}