<?php

namespace IziDev\Soap\Services;

use IziDev\Soap\Entities\Client as Entity;
use IziDev\Soap\Models\GetTotalForClient;
use IziDev\Soap\Validations\GetTotalForClientValidation;

class GetTotalForClientService
{
    /**
     * @var GetTotalForClient
     */
    private $model;

    public function __invoke(GetTotalForClient $model)
    {
        $this->model = $model;

        $this->validate();

        return $this->total();
    }

    private function validate()
    {
        (new GetTotalForClientValidation($this->model))->make();
    }

    private function total()
    {
        $this->model->total = Entity::where([
            "document" => $this->model->document,
            "phone" => $this->model->phone
        ])->first()->total();

        return $this->model;
    }
}