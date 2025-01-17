<?php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAIService
{
    private $client;
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('GROQ_API_URL', 'https://api.groq.com/openai/v1/'),
            'headers' => [
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                'Content-Type'  => 'application/json',
            ],
        ]);
    }

    public function chat($messages)
    {
        $response = $this->client->post('chat/completions', [
            'json' => [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => $messages,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }


//    public function __construct()
//    {
//        $this->client = new Client([
//            'base_uri' => 'https://api.openai.com/v1/',
//            'headers' => [
//                'Authorization' => 'Bearer ' . config('services.openai.key'),
//                'Content-Type'  => 'application/json',
//            ],
//        ]);
//    }
//
//    public function chat($messages)
//    {
//        $response = $this->client->post('chat/completions', [
//            'json' => [
//                'model' => 'gpt-3.5-turbo',
//                'messages' => $messages,
//            ],
//        ]);
//
//        return json_decode($response->getBody()->getContents(), true);
//    }
}
