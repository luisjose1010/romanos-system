<?php

namespace Framework\Configuration;

class DatabaseConfiguration
{
    public static function getConnection()
    {
        $configuration = include __DIR__ . '/../../config/database.php';
        $default = $configuration['default'];

        return $configuration['connections'][$default];
    }

    public static function getPath()
    {
        $configuration = include __DIR__ . '/../../config/database.php';

        return $configuration['path'];
    }
}
