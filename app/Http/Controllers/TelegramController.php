<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function handle(Request $request){
        $update = Telegram::getWebhookUpdate();
        $chatId=$request['message']['chat']['id'];
        $user=$request['message']['chat']['first_name'];
        $text=$request['message']['text'];
        
        if ($text=='/start' ){

            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' =>'Assalom '.$user.' xush kelibsiz ',
            ]);
        }
        if ($text=='Salom'){
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' =>'Salom nima yordam beraolaman',
            ]); 
        }

        

        // FacadesLog::info('update', [$update]);
    }

    
}
