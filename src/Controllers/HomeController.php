<?php

namespace IziDev\MiniFramework\Controllers;

class HomeController extends Controller
{
    public function run()
    {
        return $this->view("home");
    }
}