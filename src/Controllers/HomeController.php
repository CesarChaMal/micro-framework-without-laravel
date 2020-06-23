<?php

namespace IziDev\Soap\Controllers;

class HomeController extends Controller
{
    public function run()
    {
        return $this->view("home");
    }
}