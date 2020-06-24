<?php

namespace IziDev\MiniFramework\Models;

class GetTotalForClient
{
    public $document;

    public $phone;

    public $total;

    public function __construct($document, $phone, $total = null)
    {
        $this->document = $document;
        $this->phone = $phone;
        $this->total = $total;
    }

    public function toArray()
    {
        return [
            "phone" => $this->phone,
            "document" => $this->document,
            "total" => $this->total,
        ];
    }
}