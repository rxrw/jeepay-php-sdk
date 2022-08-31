<?php

namespace Reprover\Jeepay\Common;

class Config
{
    private string $key;

    private string $baseURL;

    private string $mchNo;

    private string $appId;

    private array $attributes;

    public function __construct(array $config)
    {
        $this->attributes = $config;
        $this->key = $config['key'];
        $this->baseURL = $config['base_url'];
        $this->mchNo = $config['mch_no'];
        $this->appId = $config['app_id'];
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getBaseURL(): string
    {
        return $this->baseURL;
    }

    public function getMchNo(): string
    {
        return $this->mchNo;
    }

    public function getAppId(): string
    {
        return $this->appId;
    }

    public function get(string $key, $default = null)
    {
        return $this->attributes[$key] ?? $default;
    }
}