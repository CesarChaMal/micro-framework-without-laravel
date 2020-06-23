<?php

namespace IziDev\Soap\Entities;

use Illuminate\Database\Eloquent\Model;
use IziDev\Soap\Entities\Client as ClientEntity;

class Wallet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "client_id",
        "value",
        "type",
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public static function reload($document, $phone, $value, $type)
    {
        /** @var Client $client */
        $client = ClientEntity::where([
            "document" => $document,
            "phone" => $phone
        ])->first();

        $wallet = new Wallet(["value" => $value, "type" => $type]);

        $client->wallets()->save($wallet);

        return $wallet;
    }
}
