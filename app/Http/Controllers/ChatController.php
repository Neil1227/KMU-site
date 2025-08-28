<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $userMessage = $request->input('message');

        if (!$userMessage) {
            return response()->json(['reply' => 'No message received.'], 400);
        }

        try {
            Log::info('Sending request to OpenAI...', ['message' => $userMessage]);

            $response = Http::timeout(30)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                    'Content-Type'  => 'application/json',
                ])
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-3.5-turbo',       // cheaper model
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a helpful AI chatbot assistant.'],
                        ['role' => 'user', 'content' => $userMessage],
                    ],
                    'temperature' => 0.5,             // less creative = cheaper
                    'max_tokens' => 200,              // limits response size
                ]);

            if ($response->failed()) {
                Log::error('OpenAI API error', ['status' => $response->status(), 'body' => $response->body()]);
                return response()->json([
                    'reply' => 'OpenAI API error: ' . $response->body()
                ], 500);
            }

            $data = $response->json();
            $reply = $data['choices'][0]['message']['content'] ?? 'No reply from AI.';

            Log::info('OpenAI reply received', ['reply' => $reply]);

            return response()->json(['reply' => $reply]);

        } catch (\Exception $e) {
            Log::error('Chatbot exception', ['message' => $e->getMessage()]);
            return response()->json([
                'reply' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}
