<?php

namespace App\Services;

use GuzzleHttp\Client;
use MessageSender;

class ImageMessageSender implements MessageSender
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function sendMessage($message): array
    {
        $authKey = base64_encode(config('gigachat.client_secret') . ':' . config('gigachat.api_key'));
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
        $imgTag = $response->getBody()['choices']['message']['content'];

        $imgSrc = $this->extractSrcFromImgTag($imgTag);
        if (!$imgSrc)
            return array('success' => false,'message' => 'Не удалось получить изображение');

        $response = $this->client->get("files/{$imgSrc[1]}/content", [
            'headers' => [
                'Authorization' => 'Basic ' . $authKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/img',
            ]
        ]);
        return json_decode($response->getBody()->getContents());
    }

    private function extractSrcFromImgTag($imgTag):string|false
    {
        $pattern = '/<img[^>]+src="([^"]+)"/i';
        preg_match($pattern, $imgTag, $matches);
        return $matches[1] ?? false;
    }
}
