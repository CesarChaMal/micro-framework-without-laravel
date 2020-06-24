<?php

namespace IziDev\MiniFramework\Validations;

use Exception;
use IziDev\MiniFramework\Models\Client;
use IziDev\MiniFramework\Entities\Client as Entity;

class CreateClientValidation extends ValidationFactory
{
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
     * @var Client
     */
    private $model;

    public function __construct(Client $model)
    {
        $this->model = $model;
    }

    protected function getSource()
    {
        return $this->model->toArray();
    }

    protected function afterValidation()
    {
        if (Entity::where("document", $this->model->document)->first())
            throw new Exception("The document has already been taken.");

        if (Entity::where("email", $this->model->email)->first())
            throw new Exception("The email has already been taken.");
    }
}