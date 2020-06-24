<?php

namespace IziDev\MiniFramework\Controllers\Soap;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use IziDev\MiniFramework\ServerSoap;

class GetWsdlServerSoapController
{
    public function __invoke()
    {
        $class = ServerSoap::class;

        $request = Request::capture();

        $serviceURI = $request->root() . '/soap';

        $wsdlGenerator = new \PHP2WSDL\PHPClass2WSDL($class, $serviceURI);

        $wsdlGenerator->generateWSDL();

        $wsdlXML = $wsdlGenerator->dump(true);

        return new Response($wsdlXML, 200, [
            "Content-Type" => "application/xml"
        ]);
    }
}