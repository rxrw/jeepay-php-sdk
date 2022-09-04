<?php

namespace Reprover\Jeepay\Response;

use Illuminate\Contracts\Support\Arrayable;
use Reprover\Jeepay\Common\Signature;
use Reprover\Jeepay\Exceptions\HttpException;
use Reprover\Jeepay\Exceptions\JeepayException;

abstract class BaseResponse implements Arrayable
{

    use Signature;

    private string $signature;

    private array $data;

    private string $msg;

    private string $code;

    private string $key;

    /**
     * @throws HttpException
     * @throws JeepayException
     */
    public function __construct($response, string $key, bool $is_response = true)
    {
        if (!is_array($response)) {
            $response = json_decode($response, true);
        }
        if ($is_response) {
            if ($response['code'] !== 0) {
                throw new JeepayException($response['msg'], $response['code']);
            }
            $this->signature = $response['sign'];
            $this->msg = $response['msg'];
            $this->code = $response['code'];
            $this->data = $response['data'];
        } else {
            $this->signature = $response['sign'];
            $this->data = $response;
        }
        $this->key = $key;

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
     * @throws HttpException
     */
    private function checkSign(): void
    {
        if ($this->signature !== $this->sign($this->getData(), $this->key)) {
            throw new HttpException('签名错误');
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