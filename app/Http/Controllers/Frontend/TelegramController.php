<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class TelegramController extends Controller
{
    public function sendOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'book' => 'required|string',
            'type' => 'required|string',
        ]);

        $botToken = env('TELEGRAM_BOT_TOKEN'); // Your bot token
        $chatId = env('TELEGRAM_CHAT_ID'); // Your chat ID

        $message = "New Book Order:\n";
        $message .= "Book: {$request->book}\n";
        $message .= "Type: {$request->type}\n";
        $message .= "Name: {$request->name}\n";
        $message .= "Location: {$request->location}";

        $response = Http::get("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
        ]);

        if ($response->successful()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 500);
        }
    }
}
