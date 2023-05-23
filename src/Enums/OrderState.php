<?php

namespace Reprover\Jeepay\caseants;

enum OrderState: int
{
    case CREATED = 0;
    case PAING = 1;
    case SUCCESS = 2;
    case FAIL = 3;
    case CANCEL = 4;
    case REFUNDED = 5;
    case CLOSED = 6;
}
