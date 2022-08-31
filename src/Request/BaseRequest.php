<?php

namespace Reprover\Jeepay\Request;

use Illuminate\Contracts\Support\Arrayable;
use Reprover\Jeepay\Common\Config;

abstract class BaseRequest implements Arrayable
{

    private string $mch_no;

    private string $app_id;

    private string $key;

    final public function __construct(Config $config)
    {
        $this->mch_no = $config->getMchNo();
        $this->app_id = $config->getAppId();
        $this->key = $config->getKey();
    }

    private array $attributes = [];

    abstract public function rules(): array;

    public function toArray(): array
    {
        return $this->attributes;
    }

    public function setAttribute(array $attributes = []): void
    {
        $this->attributes = $attributes;
    }

    public function getAttribute(): array
    {
        return $this->attributes;
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    /**
     * @return string
     */
    public function getMchNo(): string
    {
        return $this->mch_no;
    }

    /**
     * @return string
     */
    public function getAppId(): string
    {
        return $this->app_id;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }
}