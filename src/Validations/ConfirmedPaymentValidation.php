<?php


namespace IziDev\Soap\Validations;

use Exception;
use IziDev\Soap\Models\ConfirmedPayment;
use IziDev\Soap\Entities\Payment as Entity;

class ConfirmedPaymentValidation extends ValidationFactory
{
    protected $rules = [
        "session" => "required",
        "token" => "required|numeric"
    ];

    protected $messages = [
        "session.required" => "The session field is required.",
        "token.required" => "The token field is required.",
        "token.numeric" => "The token must be a number."
    ];

    /**
     * @var ConfirmedPayment
     */
    private $model;

    public function __construct(ConfirmedPayment $model)
    {
        $this->model = $model;
    }

    protected function getSource()
    {
        return $this->model->toArray();
    }

    protected function afterValidation()
    {
        $payment = Entity::where([
            "session" => $this->model->session,
            "token" => $this->model->token
        ])->first();

        if ($payment == null) throw new Exception("Payment not found.");
    }
}