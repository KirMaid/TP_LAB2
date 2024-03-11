<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DefaultMessageSender implements MessageSender
{
    protected string $authToken;
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
                    "content" => $prompt ?? "Ты — профессиональный маркетолог с опытом написания высококонверсионной рекламы.
                    Для генерации описания товара ты изучаешь потенциальную целевую аудиторию и оптимизируешь рекламный текст так, чтобы он обращался именно к этой целевой аудитории.
                    Создай текст объявления с привлекающим внимание заголовком и убедительным призывом к действию, который побуждает пользователей к целевому действию."
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
