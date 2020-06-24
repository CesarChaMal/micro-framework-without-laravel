<?php

namespace IziDev\MiniFramework\Controllers\Api;

use IziDev\MiniFramework\Validations\Api\PutReloadWalletClientValidation;

class PostGeneratePaymentClientController extends BaseController
{
    public function __construct()
    {
        $this->validate(new PutReloadWalletClientValidation($this->request()->all()));
    }

    public function run()
    {
        $result = $this->client()
            ->generatePayment(
                $this->request()->get("document"),
                $this->request()->get("phone"),
                $this->request()->get("value")
            );

        return $this->response($result);
    }
}