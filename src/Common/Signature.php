<?php

namespace Reprover\Jeepay\Common;

trait Signature
{

    public function checkSign(array $data, string $key): bool
    {
        $sign = $data['sign'];
        unset($data['sign']);
        return $sign === $this->sign($data, $key);
    }

    public function sign($data, $key): string
    {
        return $this->signWithMd5($data, $key);
    }

    private function signWithMd5($data, $key): string
    {
        ksort($data);
        $string = $this->toUrlParams($data);
        $string = $string . "&key=" . $key;
        return strtoupper(md5($string));
    }

    private function toUrlParams($data): string
    {
        $buff = "";
        foreach ($data as $k => $v) {
            if ($k != "sign" && $v != "" && !is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }

        return trim($buff, "&");
    }
}