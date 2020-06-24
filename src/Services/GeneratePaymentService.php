<?php

namespace IziDev\MiniFramework\Services;

use IziDev\MiniFramework\Boot\Email;
use IziDev\MiniFramework\Entities\Payment as Entity;
use IziDev\MiniFramework\Models\GeneratePayment;
use IziDev\MiniFramework\Validations\GeneratePaymentValidation;

class GeneratePaymentService
{
    /**
     * @var GeneratePayment
     */
    private $model;

    private $client;

    public function __invoke(GeneratePayment $model)
    {
        $this->model = $model;

        $this->validate();

        $this->save();

        $this->email();
    }

    private function validate()
    {
        (new GeneratePaymentValidation($this->model))->make();
    }

    private function save()
    {
        $this->model->token = $this->generateToken();
        $this->model->session = $this->generateSession();

        $this->client = Entity::generate(
            $this->model->document,
            $this->model->phone,
            $this->model->value,
            "pending",
            $this->model->token,
            $this->model->session
        );
    }

    private function generateToken()
    {
        $result = 0;

        for ($i = 0; $i < 5; $i++) {
            $result .= mt_rand(0, 9);
        }

        return $result;
    }

    private function generateSession()
    {
        return uniqid();
    }

    private function email()
    {
        (new Email)->__invoke([
            "email" => $this->client->email,
            "name" => $this->client->full_name
        ], "new token & session", "Token : {$this->model->token} - Session {$this->model->session}");
    }
}