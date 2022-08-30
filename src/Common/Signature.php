<?php

namespace Reprover\JeepayPhpSdk\Common;

trait Signature
{
    public function sign($data, $key)
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