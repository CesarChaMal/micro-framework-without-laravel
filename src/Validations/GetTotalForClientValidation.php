<?php

namespace IziDev\Soap\Validations;

use Exception;
use IziDev\Soap\Entities\Client as ClientEntity;
use IziDev\Soap\Models\GetTotalForClient;

class GetTotalForClientValidation extends ValidationFactory
{
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
     * @var GetTotalForClient
     */
    protected $model;

    /**
     * @var ClientEntity
     */
    protected $client;

    public function __construct(GetTotalForClient $model)
    {
        $this->model = $model;
    }

    protected function getSource()
    {
        return $this->model->toArray();
    }

    protected function afterValidation()
    {
        /** @var ClientEntity client */
        $this->client = ClientEntity::where([
            "document" => $this->model->document,
            "phone" => $this->model->phone
        ])->first();

        if ($this->client == null) throw new Exception("The client not found.");
    }
}