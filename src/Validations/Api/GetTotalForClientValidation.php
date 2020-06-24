<?php

namespace IziDev\MiniFramework\Validations\Api;

use IziDev\MiniFramework\Validations\ValidationFactory;

class GetTotalForClientValidation extends ValidationFactory
{
    private $params;

    protected $rules = [
        "phone" => "required|numeric",
        "document" => "required|numeric",
    ];

    protected $messages = [
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