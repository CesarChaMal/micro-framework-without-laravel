<?php

namespace IziDev\Soap\Validations\Api;

use IziDev\Soap\Validations\ValidationFactory;

class PutReloadWalletClientValidation extends ValidationFactory
{
    private $params;

    protected $rules = [
        "phone" => "required|numeric",
        "value" => "required|numeric",
        "document" => "required|numeric",
    ];

    protected $messages = [
        "value.required" => "The value field is required.",
        "value.numeric" => "The value field is required.",
        "phone.required" => "The phone field is required.",
        "phone.numeric" => "The numeric must be a number.",
        "document.required" => "The document field is required.",
        "document.numeric" => "The document must be a number.",
    ];

    /**
     * PostCreateClientValidation constructor.
     * @param $params
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    protected function getSource()
    {
        return $this->params;
    }
}