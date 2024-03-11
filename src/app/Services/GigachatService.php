<?php

namespace App\Services;

class GigachatService
{
    private static ?GigachatService $instance = null;
    private MessageSender $strategy;
    private array $observers = [];


    public function notifySuccess($message): void
    {
        foreach ($this->observers as $observer) {
            $observer->onMessageSent($message);
        }
    }

    public function notifyFailure($message, $error): void
    {
        foreach ($this->observers as $observer) {
            $observer->onMessageFailed($message, $error);
        }
    }

    public function attach(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    public function __construct()
    {
        $this->setStrategy(new DefaultMessageSender());
    }

    public static function getInstance(): GigachatService
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setStrategy(MessageSender $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function detach(Observer $observer): void
    {
        $index = array_search($observer, $this->observers, true);
        if ($index !== false) {
            unset($this->observers[$index]);
        }
    }

    public function sendMessage($message)
    {
        try {
            $message = $this->strategy->sendMessage($message);
            $this->notifySuccess($message);
            return $message;
        }
        catch (\Exception $exception){
            $this->notifyFailure($message, $exception->getMessage());
            throw $exception; // Перебрасываем исключение, чтобы обработать его в вызывающем коде
        }
    }
}
