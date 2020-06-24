<?php

namespace IziDev\MiniFramework\Controllers\Api;

use IziDev\MiniFramework\Validations\Api\GetTotalForClientValidation;

class GetTotalForClientController extends BaseController
{
    public function __construct()
    {
        $this->validate(new GetTotalForClientValidation($this->request()->all()));
    }

    public function run()
    {
        $result = $this->client()->getTotal(
            $this->request()->get("document"),
            $this->request()->get("phone")
        );

        return $this->response($result);
    }
}