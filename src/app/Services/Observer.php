<?php

interface Observer
{
    public function onMessageSent($message);
    public function onMessageFailed($message, $error);
}
