<?php

namespace IziDev\MiniFramework\Services;

use IziDev\MiniFramework\Entities\Client as Entity;
use IziDev\MiniFramework\Models\GetTotalForClient;
use IziDev\MiniFramework\Validations\GetTotalForClientValidation;

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