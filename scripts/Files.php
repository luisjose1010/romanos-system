<?php

namespace Scripts;

class Files
{
    public static function deleteDevelopment()
    {
        self::deleteDirectory(__DIR__ . '/../node_modules'); // Elimina librerias de NodeJS utilizadas al compilar
        self::deleteDirectory(__DIR__ . '/../resources/src'); // Elimina archivos que utiliza NodeJS al compilar
        self::deleteDirectory(__DIR__ . '/../documentation'); // Elimina archivos de documentación
        self::deleteDirectory(__DIR__ . '/../.git'); // Elimina carpeta git de versionado

        // Elimina archivos innecesarios para el funcionamiento de la aplicacion en producción
        unlink(__DIR__ . '/../README.md');
        unlink(__DIR__ . '/../vue.config.js');
        unlink(__DIR__ . '/../package.json');
        unlink(__DIR__ . '/../package-lock.json');
        unlink(__DIR__ . '/../.eslintrc.js');
        unlink(__DIR__ . '/../.gitignore');
        unlink(__DIR__ . '/../info.txt');
        unlink(__DIR__ . '/../.env.example');
        unlink(__DIR__ . '/../.env.local');
        unlink(__DIR__ . '/../.env.local.example');
        unlink(__DIR__ . '/../.editorconfig');
    }

    private static function deleteDirectory($dir)
    {
        if (!$dh = @opendir($dir)) {
            return;
        }
        while (false !== ($current = readdir($dh))) {
            if ($current != '.' && $current != '..') {
                if (!@unlink($dir . '/' . $current)) {
                    self::deleteDirectory($dir . '/' . $current);
                }
            }
        }
        closedir($dh);
        echo 'Se ha borrado el directorio ' . $dir . '<br/>';
        @rmdir($dir);
    }
}
