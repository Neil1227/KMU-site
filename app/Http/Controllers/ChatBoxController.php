<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatBoxController extends Controller
{
    public function send(Request $request)
    {
        $text = $request->input('message');
        Log::info("ChatBox request: " . $text); // Log user input

        try {
            $apiKey = env('GEMINI_API_KEY'); // backend API key
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateText', [
                'prompt' => [
                    'text' => $text
                ],
                'temperature' => 0.7,
                'maxOutputTokens' => 500
            ]);

            Log::info("ChatBox API response status: " . $response->status());
            Log::info("ChatBox API response body: " . $response->body());

            if (!$response->ok()) {
                return response()->json(['reply' => 'AI service error'], 500);
            }

            $data = $response->json();
            $reply = $data['candidates'][0]['output'] ?? 'No reply';

            Log::info("ChatBox reply: " . $reply); // Log final reply

            return response()->json(['reply' => $reply]);

        } catch (\Exception $e) {
            Log::error("ChatBox error: " . $e->getMessage());
            return response()->json(['reply' => 'AI service error: ' . $e->getMessage()], 500);
        }
    }
}
