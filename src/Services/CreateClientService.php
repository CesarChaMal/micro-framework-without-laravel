<?php

namespace IziDev\Soap\Services;

use IziDev\Soap\Models\Client;
use IziDev\Soap\Entities\Client as Entity;
use IziDev\Soap\Validations\CreateClientValidation;

class CreateClientService
{
    /**
     * @var Client
     */
    private $model;

    public function __invoke(Client $model)
    {
        $this->model = $model;

        $this->validate();

        $this->save();
    }

    private function validate()
    {
        (new CreateClientValidation($this->model))->make();
    }

    private function save()
    {
        Entity::create($this->model->toArray());
    }
}