<?php


namespace IziDev\MiniFramework\Controllers\Api;

use Illuminate\Http\Response;
use SoapClient;
use IziDev\MiniFramework\Controllers\Controller;

abstract class BaseController extends  Controller
{
    public function client()
    {
        $url = $_SERVER["URL_SOAP"] . "/soap";

        $params = ['location' => $url, 'uri' => 'urn://' . $url, 'trace' => 1];

        return new SoapClient(null, $params);
    }

    public function response($response)
    {
        return $this->json($response->body, $response->state);
    }

    protected function json($body, $status)
    {
        if ($status == "OK") $status = 200;
        if ($status == "ERROR") $status = 400;

        return new Response(json_encode($body), $status, [
            "Content-Type" => "application/json"
        ]);
    }
}