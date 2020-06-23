<?php

namespace IziDev\Soap\Controllers\Api;

use IziDev\Soap\Validations\Api\PostConfirmedPaymentClientValidation;

class PostConfirmedPaymentClientController extends BaseController
{
    public function __construct()
    {
        $this->validate(new PostConfirmedPaymentClientValidation($this->request()->all()));
    }

    public function run()
    {
        $result = $this->client()
            ->confirmedPayment(
                $this->request()->get("token"),
                $this->request()->get("session")
            );

        return $this->response($result);
    }
}