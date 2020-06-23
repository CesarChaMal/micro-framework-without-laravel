<?php

namespace IziDev\Soap\Validations\Api;

use IziDev\Soap\Validations\ValidationFactory;

class PostConfirmedPaymentClientValidation extends ValidationFactory
{
    /**
     * @var array
     */
    private $all;

    protected $rules = [
        "session" => "required",
        "token" => "required|numeric"
    ];

    protected $messages = [
        "session.required" => "The session field is required.",
        "token.required" => "The token field is required.",
        "token.numeric" => "The token must be a number."
    ];

    /**
     * PostConfirmedPaymentClientValidation constructor.
     * @param array $all
     */
    public function __construct(array $all)
    {
        $this->all = $all;
    }

    protected function getSource()
    {
        return $this->all;
    }
}