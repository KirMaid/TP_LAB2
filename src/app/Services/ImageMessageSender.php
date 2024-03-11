<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ImageMessageSender implements MessageSender
{
    protected string $authToken;
    public function getImage($response){
        $imgTag = $response['choices']['message']['content'];
        $imgSrc = $this->extractSrcFromImgTag($imgTag);
        if (!$imgSrc)
            return array('success' => false,'message' => 'Не удалось получить изображение');
    }

    public function getImageContent($imgSrc)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $this->authToken,
            'Content-Type' => 'application/json',
            'Accept' => 'application/img',
        ])->get("files/{$imgSrc[1]}/content");

        if ($response->successful()) {
            return $response->body();
        } else {
            throw new \Exception('Не удалось получить изображение' . $response->body());
        }
    }

    public function sendMessage($message, $prompt = null): array
    {
        if (!isset($this->authToken))
            $this->getAuthToken();
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $this->authToken,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->withOptions(['verify' => false])->post(self::defaultApiPath . 'chat/completions', [
            'model' => 'GigaChat:latest',
            'messages' => [
                [
                    "role" => "system",
                    "content" => $prompt ?? "Сгенерируй изображение."
                ],
                [
                    "role" => "user",
                    "content" => $message
                ]
            ],
            'temperature' => 0.87,
            'top_p' => 0.47,
            'n' => 1,
            'stream' => false,
            'max_tokens' => 512,
            'repetition_penalty' => 1.07,
            'update_interval' => 0,
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception('Произошла ошибка при запросе: ' . $response->body());
        }
    }

    private function extractSrcFromImgTag($imgTag):string|false
    {
        $pattern = '/<img[^>]+src="([^"]+)"/i';
        preg_match($pattern, $imgTag, $matches);
        return $matches[1] ?? false;
    }

    public function getAuthToken()
    {
        $authKey = base64_encode(config('gigachat.client_id') . ':' . config('gigachat.client_secret'));
        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Accept' => 'application/json',
            'RqUID' => uniqid(),
            'Authorization' => 'Basic ' . $authKey,
        ])->withOptions(['verify' => false])->asForm()->post(self::defaultAuthPath, [
            'scope' => 'GIGACHAT_API_PERS'
        ]);

        $responseBody = $response->json();
        return $responseBody;
    }
}
