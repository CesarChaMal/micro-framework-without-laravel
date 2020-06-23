<?php

namespace IziDev\Soap\Models;

class GeneratePayment extends ReloadWallet
{
    public $session;

    public $token;

    public function __construct($document, $phone, $value, $session = null, $token = null)
    {
        $this->document = $document;
        $this->phone = $phone;
        $this->value = $value;
        $this->session = $session;
        $this->token = $token;
    }

    public function toArray()
    {
        return [
            "document" => $this->document,
            "phone" => $this->phone,
            "value" => $this->value,
            "session" => $this->session,
            "token" => $this->token,
        ];
    }
}