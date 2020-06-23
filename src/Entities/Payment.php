<?php

namespace IziDev\Soap\Entities;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "wallet_id",
        "token",
        "session",
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public static function generate($document, $phone, $value, $type, $token, $session)
    {
        /** @var Wallet $wallet */
        $wallet = Wallet::reload($document, $phone, $value, $type);

        $payment = new Payment(["token" => $token, "session" => $session]);

        $wallet->payments()->save($payment);

        return $wallet->client;
    }

    public static function confirmed($token, $session)
    {
        /** @var Payment $payment */
        $payment = self::where([
            "session" => $session,
            "token" => $token,
        ])->first();

        $payment->wallet()->update([
            "type" => "discount"
        ]);
    }
}
