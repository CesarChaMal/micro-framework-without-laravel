<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('clients', function ($table) {
    $table->id();
    $table->string("document")->unique();
    $table->string("full_name");
    $table->string("email")->unique();
    $table->string("phone");
    $table->timestamps();
});

Capsule::schema()->create('wallets', function ($table) {
    $table->id();
    $table->foreignId("client_id");
    $table->bigInteger("value");
    $table->enum("type", ["discount", "increase", "pending"]);
    $table->timestamps();
});

Capsule::schema()->create('payments', function ($table) {
    $table->id();
    $table->foreignId("wallet_id")->nullable();
    $table->string("token", 6)->unique();
    $table->string("session")->unique();
    $table->timestamps();
});