<?php

namespace MiniStore\Modules\Core;

trait LoggerTrait
{
    public function log(string $message): void
    {
        $timestamp = date('Y-m-d H:i:s');
        echo "[$timestamp] LOG: $message" . PHP_EOL;
    }
}
