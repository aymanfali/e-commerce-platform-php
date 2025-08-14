<?php

spl_autoload_register(function ($className) {
    $file = str_replace('\\', '/', $className) . '.php';
    $path = __DIR__ . '/src/' . $file;
    if (file_exists($path)) {
        require $path;
    }
});