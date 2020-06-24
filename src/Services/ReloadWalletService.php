<?php

namespace IziDev\MiniFramework\Services;

use IziDev\MiniFramework\Entities\Wallet as Entity;
use IziDev\MiniFramework\Models\ReloadWallet;
use IziDev\MiniFramework\Validations\ReloadWalletValidation;

class ReloadWalletService
{
    /**
     * @var ReloadWallet
     */
    private $model;

    public function __invoke(ReloadWallet $model)
    {
        $this->model = $model;

        $this->validate();

        $this->save();
    }

    private function validate()
    {
        (new ReloadWalletValidation($this->model))->make();
    }

    private function save()
    {
        Entity::reload($this->model->document, $this->model->phone, $this->model->value, "increase");
    }
}