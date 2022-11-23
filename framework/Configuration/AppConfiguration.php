<?php

namespace Framework\Configuration;

class AppConfiguration
{
    public static function getDevelopmentMode(): bool
    {
        $configuration = include __DIR__ . '/../../config/app.php';
        return $configuration['developmentMode'];
    }

    public static function getAppServer(): bool
    {
        $configuration = include __DIR__ . '/../../config/app.php';
        return $configuration['appServer'];
    }
}
