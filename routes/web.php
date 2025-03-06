<?php

use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

Route::get('/', function () {
    return view('welcome');
});
Route::get('setwebhoog', function(){
    $response = Telegram::setWebhook(['url' => 'https://ab60-77-247-198-203.ngrok-free.app/api/telegram/webhook']);
    
});