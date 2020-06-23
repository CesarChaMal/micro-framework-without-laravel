<?php

namespace IziDev\Soap\Validations;

use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Validation\ValidationException;

abstract class ValidationFactory
{
    protected $source;

    protected $rules;

    protected $messages;

    abstract protected function getSource();

    public function make()
    {
        $translator = new Translator(new ArrayLoader(), 'en_US');
        $validatorFactory = new ValidatorFactory($translator);
        $validator = $validatorFactory->make($this->getSource(), $this->rules, $this->messages);

        if ($validator->fails()) throw new ValidationException($validator);

        $this->afterValidation();
    }

    protected function afterValidation()
    {

    }
}