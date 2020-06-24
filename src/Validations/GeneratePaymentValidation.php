<?php


namespace IziDev\MiniFramework\Validations;

use Exception;

class GeneratePaymentValidation extends ReloadWalletValidation
{
    protected function afterValidation()
    {
        parent::afterValidation();

        if ($this->client->total() == 0) throw new Exception("balance total is zero");
    }
}