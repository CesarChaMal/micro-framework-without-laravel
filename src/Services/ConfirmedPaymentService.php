<?php

namespace IziDev\Soap\Services;

use IziDev\Soap\Entities\Payment as Entity;
use IziDev\Soap\Models\ConfirmedPayment;
use IziDev\Soap\Validations\ConfirmedPaymentValidation;

class ConfirmedPaymentService
{
    /**
     * @var ConfirmedPayment
     */
    private $model;

    public function __invoke(ConfirmedPayment $model)
    {
        $this->model = $model;

        $this->validate();

        $this->save();
    }

    private function validate()
    {
        (new ConfirmedPaymentValidation($this->model))->make();
    }

    private function save()
    {
        Entity::confirmed(
            $this->model->token,
            $this->model->session
        );
    }
}