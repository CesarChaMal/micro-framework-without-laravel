<?php

namespace IziDev\MiniFramework\Validations\Api;

use IziDev\MiniFramework\Validations\ValidationFactory;

class PostCreateClientValidation extends ValidationFactory
{
    private $params;

    protected $rules = [
        "full_name" => "required",
        "email" => "required|email",
        "phone" => "required|numeric",
        "document" => "required|numeric",
    ];

    protected $messages = [
        "full_name.required" => "The full_name field is required.",
        "phone.required" => "The phone field is required.",
        "phone.numeric" => "The numeric must be a number.",
        "email.required" => "The email field is required.",
        "email.email" => "The email must be a valid email address.",
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