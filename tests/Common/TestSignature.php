<?php

namespace Common;

use PHPUnit\Framework\TestCase;
use Reprover\JeepayPhpSdk\Common\Signature;

class TestSignature extends TestCase
{
    public function testSign()
    {

        $signature = new class {
            use Signature;
        };

        $data['platId'] = "1000";
        $data['mchOrderNo'] = "P0123456789101";
        $data['amount'] = "10000";
        $data['clientIp'] = "192.168.0.111";
        $data['returnUrl'] = "https://www.baidu.com";
        $data['notifyUrl'] = "https://www.baidu.com";
        $data['reqTime'] = "20190723141000";
        $data['version'] = "1.0";
        $key = 'EWEFD123RGSRETYDFNGFGFGSHDFGH';
        $result = $signature->sign($data, $key);
        $this->assertEquals('84E1CA56F984502BBAC06EA6707157F5', $result);
    }
}