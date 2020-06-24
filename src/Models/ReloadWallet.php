<?php

namespace IziDev\MiniFramework\Models;

class ReloadWallet
{
    public $document;

    public $phone;

    public $value;

    public function __construct($document, $phone, $value)
    {
        $this->document = $document;
        $this->phone = $phone;
        $this->value = $value;
    }

    public function toArray()
    {
        return [
            "document" => $this->document,
            "phone" => $this->phone,
            "value" => $this->value,
        ];
    }
}