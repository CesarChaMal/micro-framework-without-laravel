<?php

namespace IziDev\Soap\Models;

class ConfirmedPayment
{
    public $session;

    public $token;

    public function __construct($token,$session)
    {
        $this->session = $session;
        $this->token = $token;
    }

    public function toArray()
    {
        return [
            "session" => $this->session,
            "token" => $this->token,
        ];
    }
}