<?php

namespace IziDev\MiniFramework;


use Illuminate\Validation\ValidationException;
use IziDev\MiniFramework\Models\Client;
use IziDev\MiniFramework\Models\ConfirmedPayment;
use IziDev\MiniFramework\Models\GeneratePayment;
use IziDev\MiniFramework\Models\GetTotalForClient;
use IziDev\MiniFramework\Models\ReloadWallet;
use IziDev\MiniFramework\Services\ConfirmedPaymentService;
use IziDev\MiniFramework\Services\CreateClientService;
use IziDev\MiniFramework\Services\GeneratePaymentService;
use IziDev\MiniFramework\Services\GetTotalForClientService;
use IziDev\MiniFramework\Services\ReloadWalletService;

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