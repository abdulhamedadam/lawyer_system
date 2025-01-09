<?php

namespace App\Http\Controllers;

use App\Services\OpenAIService;
use Illuminate\Http\Request;

class ChatGPTController extends Controller
{
    private $openAIService;
    /*******************************************************/
    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }
    /*******************************************************/
    public function ask(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $messages = [
            ['role' => 'system', 'content' => 'You are a helpful assistant.'],
            ['role' => 'user', 'content' => $request->message],
        ];

        $response = $this->openAIService->chat($messages);

        return response()->json($response);
    }
    /*******************************************************/
}
