<?php

namespace IziDev\MiniFramework\Entities;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "document",
        "full_name",
        "email",
        "phone",
    ];

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function total()
    {
        $increase = $this->wallets()->where("type", "increase")->sum("value");
        $discount = $this->wallets()->where("type", "discount")->sum("value");

        return $increase - $discount;
    }
}
