<?php

namespace IziDev\Soap;


use Illuminate\Validation\ValidationException;
use IziDev\Soap\Models\Client;
use IziDev\Soap\Models\ConfirmedPayment;
use IziDev\Soap\Models\GeneratePayment;
use IziDev\Soap\Models\GetTotalForClient;
use IziDev\Soap\Models\ReloadWallet;
use IziDev\Soap\Services\ConfirmedPaymentService;
use IziDev\Soap\Services\CreateClientService;
use IziDev\Soap\Services\GeneratePaymentService;
use IziDev\Soap\Services\GetTotalForClientService;
use IziDev\Soap\Services\ReloadWalletService;

class ServerSoap
{
    public $state;

    public $body;

    public function createClient($document, $fullName, $email, $phone)
    {
        return $this->response(function () use ($document, $fullName, $email, $phone) {
            (new CreateClientService)->__invoke(new Client($document, $fullName, $email, $phone));
            return null;
        });
    }

    public function reloadWallet($document, $phone, $value)
    {
        return $this->response(function () use ($document, $phone, $value) {
            (new ReloadWalletService())->__invoke(new ReloadWallet($document, $phone, $value));
            return null;
        });
    }

    public function generatePayment($document, $phone, $value)
    {
        return $this->response(function () use ($document, $phone, $value) {
            (new GeneratePaymentService())->__invoke(new GeneratePayment($document, $phone, $value));
            return null;
        });
    }

    public function confirmedPayment($token, $session)
    {
        return $this->response(function () use ($token, $session) {
            (new ConfirmedPaymentService())->__invoke(new ConfirmedPayment($token, $session));
            return null;
        });
    }

    public function getTotal($document, $phone)
    {
        return $this->response(function () use ($document, $phone) {
            return (new GetTotalForClientService())->__invoke(new GetTotalForClient($document, $phone))->total;
        });
    }

    private function response($callable)
    {
        try {
            $this->body = call_user_func($callable);
            $this->state = "OK";

        } catch (\Exception $exception) {
            $this->state = "ERROR";
            $this->body = $exception->getMessage();

            if ($exception instanceof ValidationException) {
                $this->body = json_encode($exception->errors());
            }
        }

        return $this;
    }
}