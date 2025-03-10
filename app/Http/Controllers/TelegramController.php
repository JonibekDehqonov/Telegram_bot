<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    public function handle()
    {
        $update = Telegram::commandsHandler(true);
        $message = $update->getMessage();
        
        if ($message) {
            $chatId = $message->getChat()->getId();
            $text = $message->getText();

            if ($text === "/start") {
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => "Привет! Отправь команду /bus чтобы узнать местоположение автобусов.",
                ]);
            }

            if ($text === "/bus") {
                return $this->sendBusLocation($chatId);
            }
        }

        return response()->json(['status' => 'ok']);
    }

    private function sendBusLocation($chatId)
    {
        // Здесь можно получить данные из API автобусов или базы данных
        $latitude = 40.712776; // пример координаты
        $longitude = -74.005974;
        $address = "New York, Times Square"; // Заглушка

        // Отправляем сообщение с картой
        Telegram::sendLocation([
            'chat_id' => $chatId,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);

        Telegram::sendMessage([
            'chat_id' => $chatId,
            'text' => "Автобус находится здесь: $address",
        ]);
    }
}
