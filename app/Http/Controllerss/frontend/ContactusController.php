<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    public function index()
    {
        return view("frontend.contact.index");
    }




    public function sendTelegramMessage(Request $request)
{   
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'telegram' => 'nullable|string|max:255',
        'message' => 'required|string|min:10',
    ]);

    // $botToken = env('TELEGRAM_BOT_TOKEN'); 
    // $chatId = env('TELEGRAM_CHAT_ID'); 
     $botToken = '8004075610:AAG_SOdxRL1wXURbPHLzhpAn6pzs_M-zupM'; 
    $chatId = '5630998280'; 
    //     TELEGRAM_BOT_TOKEN = '8004075610:AAG_SOdxRL1wXURbPHLzhpAn6pzs_M-zupM';
    //    TELEGRAM_CHAT_ID = '5630998280';

    $messageText = "New Contact Form Submission:\n"
        . "Name: " . $validated['name'] . "\n"
        . "Email: " . $validated['email'] . "\n"
        . ($validated['telegram'] ? "Telegram: " . $validated['telegram'] . "\n" : "")
        . "Message: " . $validated['message'];

    // Encode the message for URL safety
    $encodedMessage = urlencode($messageText);

    // Build the Telegram API URL
    $url = "https://api.telegram.org/bot{$botToken}/sendMessage?chat_id={$chatId}&text={$encodedMessage}&parse_mode=HTML";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false); // Disable SSL verification
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if (curl_errno($ch)) {
       
        return response()->json(['success' => false, 'error' => 'cURL error: ' . curl_error($ch)], 500);
    }

    $responseData = json_decode($response, true);
   

    if ($httpCode === 200 && $responseData['ok']) {
        return redirect('contact')->with('success','Message sent successfully ,Thank You!');
        // return response()->json(['success' => true, 'message' => 'Message sent successfully!']);
    } else {
        return redirect('contact')->with('error','Something was working ,Thank You!');
        // return response()->json(['success' => false, 'error' => $responseData['description'] ?? 'Unknown error'], 500);
    }
}
}
