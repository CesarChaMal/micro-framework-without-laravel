<?php

namespace IziDev\MiniFramework\Services;

use IziDev\MiniFramework\Models\Client;
use IziDev\MiniFramework\Entities\Client as Entity;
use IziDev\MiniFramework\Validations\CreateClientValidation;

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