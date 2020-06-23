<?php


namespace IziDev\Soap\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use IziDev\Soap\Boot\Blade;
use IziDev\Soap\Validations\ValidationFactory;

abstract class Controller
{
    /**
     * @var ValidationFactory
     */
    private $validation = null;

    abstract public function run();

    public function __invoke()
    {
        if ($validation = $this->responseValidate()) {
            return $validation;
        }

        return $this->run();
    }

    private function responseValidate()
    {
        if (!$this->validation) return null;

        try {
            $this->validation->make();

            return null;
        } catch (ValidationException $exception) {
            return $this->json(json_encode($exception->errors()), 402);
        } catch (Exception $exception) {
            return $this->json($exception->getMessage(), 402);
        }
    }

    protected function request()
    {
        return Request::capture();
    }

    protected function validate(ValidationFactory $validation)
    {
        $this->validation = $validation;
    }

    protected function view($viewFile, $arguments = [])
    {
        $blade = new Blade();

        return new Response($blade->__invoke($viewFile, $arguments), 200);
    }
}