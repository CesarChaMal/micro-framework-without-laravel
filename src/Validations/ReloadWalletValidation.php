<?php


namespace IziDev\MiniFramework\Validations;

use Exception;
use IziDev\MiniFramework\Entities\Client as ClientEntity;
use IziDev\MiniFramework\Models\ReloadWallet;

class ReloadWalletValidation extends ValidationFactory
{
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
     * @var ReloadWallet
     */
    protected $model;

    /**
     * @var ClientEntity
     */
    protected $client;

    public function __construct(ReloadWallet $model)
    {
        $this->model = $model;

        $this->client = ClientEntity::where([
            "document" => $this->model->document,
            "phone" => $this->model->phone
        ])->first();
    }

    protected function getSource()
    {
        return $this->model->toArray();
    }

    protected function afterValidation()
    {
        if ($this->client == null) throw new Exception("The client not found.");
    }
}