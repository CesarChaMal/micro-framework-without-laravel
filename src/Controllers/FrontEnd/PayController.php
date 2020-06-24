<?php


namespace IziDev\MiniFramework\Controllers\FrontEnd;

use IziDev\MiniFramework\Controllers\Controller;

class PayController extends Controller
{
    public function run()
    {
        return $this->view("Pay.index");
    }
}