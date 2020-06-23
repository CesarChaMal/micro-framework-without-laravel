<?php


namespace IziDev\Soap\Controllers\FrontEnd;

use IziDev\Soap\Controllers\Controller;

class PayController extends Controller
{
    public function run()
    {
        return $this->view("Pay.index");
    }
}