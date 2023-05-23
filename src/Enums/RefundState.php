<?php

namespace Reprover\Jeepay\caseants;

enum RefundState: int
{
    case CREATED = 0;
    case REFUNDING = 1;
    case SUCCESS = 2;
    case FAIL = 3;
    case CLOSED = 4;
}