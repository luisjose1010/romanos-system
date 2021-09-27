<?php

namespace Framework\Configuration;

class AppConfiguration
{
    public static function getDebugMode(): bool
    {
        $configuration = include __DIR__ . '/../../config/app.php';
        return $configuration['debugMode'];
    }
}
