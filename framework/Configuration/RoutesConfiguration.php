<?php

namespace Framework\Configuration;

class RoutesConfiguration
{
    public static function getPath()
    {
        $configuration = include __DIR__ . '/../../config/routes.php';
        return $configuration["path"];
    }

    public static function getApiPath()
    {
        $configuration = include __DIR__ . '/../../config/routes.php';
        return $configuration["apiPath"];
    }
}
