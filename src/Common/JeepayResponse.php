<?php

namespace Reprover\Jeepay\Common;

use Reprover\Jeepay\Support\Signature;
use Reprover\Jeepay\Exceptions\HttpException;
use Reprover\Jeepay\Exceptions\JeepayException;

class JeepayResponse
{

    use Signature;

    private string $signature;

    private array $data;

    private string $msg;

    private string $code;

    private string $key;

    /**
     * @throws JeepayException
     */
    public function __construct($response, string $key)
    {
        if (!is_array($response)) {
            $response = json_decode($response, true);
        }
        if ($response['code'] !== 0) {
            throw new JeepayException($response['msg'], $response['code']);
        }
        $this->signature = $response['sign'];
        $this->msg       = $response['msg'];
        $this->code      = $response['code'];
        $this->data      = $response['data'];
        $this->key       = $key;

        $this->checkSign();
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @throws \Reprover\Jeepay\Exceptions\JeepayException
     */
    private function checkSign(): void
    {
        if ($this->signature !== $this->sign($this->getData(), $this->key)) {
            throw new JeepayException('签名错误');
        }
    }

    /**
     * @return string
     */
    public function getMsg(): string
    {
        return $this->msg;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    public function isSuccess(): bool
    {
        return $this->code === '0';
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
