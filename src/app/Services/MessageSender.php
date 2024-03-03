<?php
interface MessageSender
{
    public function sendMessage($message): array;
}
