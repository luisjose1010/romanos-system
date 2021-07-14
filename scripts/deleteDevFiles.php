<?php

deleteDirectory('../node_modules'); // Eliminar librerias de NodeJS ya compiladas
deleteDirectory('../resources/assets'); // Elminar archivos que utiliza NodeJS al compilar
deleteDirectory('../documentation'); // Elminar archivos de documentación
deleteDirectory('../.git'); // Elminar carpeta git de versionado

// Eliminar archivos innecesarios para el funcionamiento de la aplicacion
unlink('../README.md');
unlink('../webpack.mix.js');
unlink('../package.json');
unlink('../package-lock.json');
unlink('../mix-manifest.json');
unlink('../.gitignore');
unlink('../info.txt');
unlink('../.env.example');


function deleteDirectory($dir)
{
    if (!$dh = @opendir($dir)) return;
    while (false !== ($current = readdir($dh))) {
        if ($current != '.' && $current != '..') {
            if (!@unlink($dir . '/' . $current))
                deleteDirectory($dir . '/' . $current);
        }
    }
    closedir($dh);
    echo 'Se ha borrado el directorio ' . $dir . '<br/>';
    @rmdir($dir);
}
