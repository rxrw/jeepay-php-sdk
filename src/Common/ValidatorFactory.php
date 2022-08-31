<?php

namespace Reprover\Jeepay\Common;

use Illuminate\Validation;
use Illuminate\Translation;
use Illuminate\Filesystem\Filesystem;
use Reprover\Jeepay\Entities\BaseEntity;
use Reprover\Jeepay\Request\BaseRequest;

class ValidatorFactory
{
    private Validation\Factory $factory;

    public function __construct()
    {
        $this->factory = new Validation\Factory(
            $this->loadTranslator()
        );
    }

    protected function loadTranslator(): Translation\Translator
    {
        $filesystem = new Filesystem();
        $loader = new Translation\FileLoader(
            $filesystem, dirname(__FILE__, 2) . '/lang');
        $loader->addNamespace(
            'lang',
            dirname(__FILE__, 2) . '/lang'
        );
        $loader->load('en', 'en', 'lang');
        return new Translation\Translator($loader, 'en');
    }

    /**
     * @param BaseRequest $request
     * @return array
     */
    public function validate(BaseRequest $request): array
    {
        return $this->factory->make($request->toArray(), $request->rules())->validate();
    }

    /**
     * @param array $request
     * @param array $rules
     * @return array
     */
    public function validateNotify(BaseEntity $entity): array
    {
        return $this->factory->make($entity->toArray(), $entity->rules())->validate();
    }

    public function __call($method, $args)
    {
        return call_user_func_array(
            [$this->factory, $method],
            $args
        );
    }
}