<?php

namespace IziDev\MiniFramework\Services;

use IziDev\MiniFramework\Entities\Payment as Entity;
use IziDev\MiniFramework\Models\ConfirmedPayment;
use IziDev\MiniFramework\Validations\ConfirmedPaymentValidation;

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