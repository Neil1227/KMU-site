<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GeminiChatController extends Controller
{
    public function send(Request $request)
    {
        $userMessage = $request->input('message');

        if (!$userMessage) {
            return response()->json(['reply' => 'No message received.'], 400);
        }

        try {
            $client = new Client([
                'base_uri' => 'https://generativelanguage.googleapis.com/v1beta/',
                'timeout'  => 30,
            ]);

            $response = $client->post('models/gemini-1.5-flash:generateText', [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('GOOGLE_AI_API_KEY'),
                    'Content-Type'  => 'application/json',
                ],
                'json' => [
                    'prompt' => [
                        ['text' => $userMessage]
                    ],
                    'temperature' => 0.7,
                    'candidate_count' => 1
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            $replyText = $data['candidates'][0]['output'] ?? 'No response from Gemini.';

            return response()->json(['reply' => $replyText]);

        } catch (\Exception $e) {
            \Log::error('Gemini API error', ['message' => $e->getMessage()]);
            return response()->json(['reply' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
