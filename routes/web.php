<?php

use IziDev\MiniFramework\Controllers\Api\GetTotalForClientController;
use IziDev\MiniFramework\Controllers\Api\PostConfirmedPaymentClientController;
use IziDev\MiniFramework\Controllers\Api\PostCreateClientController;
use IziDev\MiniFramework\Controllers\Api\PostGeneratePaymentClientController;
use IziDev\MiniFramework\Controllers\Api\PutReloadWalletClientController;
use IziDev\MiniFramework\Controllers\FrontEnd\PayController;
use IziDev\MiniFramework\Controllers\HomeController;
use IziDev\MiniFramework\Controllers\Soap\GenerateServerSoapController;
use IziDev\MiniFramework\Controllers\Soap\GetWsdlServerSoapController;

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