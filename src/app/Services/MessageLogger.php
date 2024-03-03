<?php

class MessageLogger implements Observer
{
    public function onMessageSent($message)
    {
        echo "Сообщение успешно отправлено: {$message}\n";
    }

    public function onMessageFailed($message, $error)
    {
        echo "Ошибка при отправке сообщения: {$message}. Ошибка: {$error}\n";
    }
}
