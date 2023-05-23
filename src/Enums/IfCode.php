<?php

namespace Reprover\Jeepay\Enums;

enum IfCode: string
{
    case WECHATPAY = 'wxpay';
    case ALIPAY = 'alipay';
}