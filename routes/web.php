<?php

use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

Route::get('/', function () {
    return view('welcome');
});
Route::get('setwebhoog', function(){
    $response = Telegram::setWebhook(['url' => 'https://03cf-77-247-198-144.ngrok-free.app/api/telegram/webhook']);
    
});