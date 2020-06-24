<?php

namespace IziDev\MiniFramework\Models;

class Client
{
    public $document;

    public $full_name;

    public $email;

    public $phone;

    public function __construct($document, $full_name, $email, $phone)
    {
        $this->document = $document;
        $this->full_name = $full_name;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function toArray()
    {
        return [
            "full_name" => $this->full_name,
            "email" => $this->email,
            "phone" => $this->phone,
            "document" => $this->document,
        ];
    }
}