<?php

namespace Reprover\Jeepay\Constants;

class RefundState
{
    const CREATED = 0;
    const REFUNDING = 1;
    const SUCCESS = 2;
    const FAIL = 3;
    const CLOSED = 4;
}