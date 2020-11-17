<?php

declare(strict_types=1);

namespace App\Interfaces;

interface MessageBusInterface
{
    public function dispatch(object $message);
}