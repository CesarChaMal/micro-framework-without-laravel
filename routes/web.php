<?php

use IziDev\Soap\Controllers\Api\GetTotalForClientController;
use IziDev\Soap\Controllers\Api\PostConfirmedPaymentClientController;
use IziDev\Soap\Controllers\Api\PostCreateClientController;
use IziDev\Soap\Controllers\Api\PostGeneratePaymentClientController;
use IziDev\Soap\Controllers\Api\PutReloadWalletClientController;
use IziDev\Soap\Controllers\FrontEnd\PayController;
use IziDev\Soap\Controllers\HomeController;
use IziDev\Soap\Controllers\Soap\GenerateServerSoapController;
use IziDev\Soap\Controllers\Soap\GetWsdlServerSoapController;

return [
    "/" => HomeController::class,
    "/soap" => GenerateServerSoapController::class,
    "/soap/wsdl" => GetWsdlServerSoapController::class,
    "/api/client" => PostCreateClientController::class,
    "/api/client/total" => GetTotalForClientController::class,
    "/api/client/reload-wallet" => PutReloadWalletClientController::class,
    "/api/client/payment/generate" => PostGeneratePaymentClientController::class,
    "/api/client/payment/confirmed" => PostConfirmedPaymentClientController::class,
    "/frontend" => PayController::class
];