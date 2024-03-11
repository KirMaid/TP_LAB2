<?php
namespace App\Services;

interface MessageSender
{
    const defaultApiPath = 'https://gigachat.devices.sberbank.ru/api/v1/';
    const defaultAuthPath = 'https://ngw.devices.sberbank.ru:9443/api/v2/oauth';
    public function sendMessage($message): array;
    public function getAuthToken();
}
