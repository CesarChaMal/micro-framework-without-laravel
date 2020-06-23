<?php

namespace IziDev\Soap\Controllers\Api;

use IziDev\Soap\Validations\Api\PutReloadWalletClientValidation;

class PutReloadWalletClientController extends BaseController
{
    public function __construct()
    {
        $this->validate(new PutReloadWalletClientValidation($this->request()->all()));
    }

    public function run()
    {
        $result = $this->client()
            ->reloadWallet(
                $this->request()->get("document"),
                $this->request()->get("phone"),
                $this->request()->get("value")
            );

        return $this->response($result);
    }
}