<?php

namespace App\Services;

use GuzzleHttp\Client;

class GigachatService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://gigachat.devices.sberbank.ru/api/v1/chat/',
            'verify' => false
        ]);
    }

    public function sendMessage($message)
    {
        $authKey = base64_encode(config('gigachat.client_secret').':'.config('gigachat.api_key'));
        $response = $this->client->post('completions', [
            'headers' => [
                'Authorization' => 'Basic ' . $authKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'model' => 'GigaChat:latest',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $message,
                    ]
                ],
                'temperature' => 0.87,
                'top_p' => 0.47,
                'n' => 1,
                'stream' => false,
                'max_tokens' => 512,
                'repetition_penalty' => 1.07,
                'update_interval' => 0,
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

}
