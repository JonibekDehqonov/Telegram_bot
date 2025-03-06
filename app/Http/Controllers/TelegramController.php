<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    private $adminId = '2051239590';
    public function handle(Request $request){
        $update = Telegram::getWebhookUpdate();
        $chatId=$request['message']['chat']['id'];
        $user=$request['message']['chat']['first_name'];
        // $text=$request['message']['text'];
        $update = Telegram::commandsHandler(true);
        $message = $update->getMessage();
        
        if ($message=='/start' ){

            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' =>'Assalom '.$user.' xush kelibsiz ',
            ]);
        }
        if ($message=='Salom'){
            Telegram::sendMessage([
                'chat_id' => '2051239590',
                'text' =>'Salom nima yordam beraolaman',
            ]); 
        }

        if ($message && $message->has('location')) {
            $location = $message->get('location');
            $lat = $location['latitude'];
            $lon = $location['longitude'];

           $mapUrl = "https://yandex.ru/maps/?ll={$lon},{$lat}&z=15";
            Telegram::sendMessage([
                'chat_id' => $message->getChat()->getId(),
                'text' => "Sizning joylashuvingiz: $mapUrl",
            ]);
            Telegram::sendMessage([
                'chat_id' => $this->adminId,
                'text' => "Foydalanuvchi " . $message->getChat()->getId() . " joylashuvi: $mapUrl",
            ]);
        } else {
            Telegram::sendMessage([
                'chat_id' => $message->getChat()->getId(),
                'text' => "Iltimos, o'z lokatsiyangizni yuboring.",
                'reply_markup' => json_encode([
                    'keyboard' => [[['text' => '📍 Lokatsiyani yuborish', 'request_location' => true]]],
                    'resize_keyboard' => true,
                    'one_time_keyboard' => true,
                ]),
            ]);
        }

        

        // FacadesLog::info('update', [$update]);
    }

    
}