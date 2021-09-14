<?php

namespace Scripts;

use Framework\Configuration\DatabaseConfiguration;
use PDO;

class Database
{
     public static function buildSchema()
     {
          $message = "Se han creado las tablas correctamente";

          self::setup();
          self::executeFile('buildSchema', $message);
     }

     public static function defaultSeed()
     {
          $message = "Se han insertado datos predeterminados a las tablas correctamente";

          self::setup();
          self::executeFile('defaultSeed', $message);
     }

     private static function executeFile($fileName, $message)
     {
          $configuration = DatabaseConfiguration::getConnection();

          $filesPath = DatabaseConfiguration::getPath();

          $username = $configuration['username'];
          $password = $configuration['password'];

          $dsn = "{$configuration['driver']}:host={$configuration['host']};";
          $dsn = $dsn . "dbname={$configuration['database']};";
          $dsn = $dsn . "port={$configuration['port']}";
          $dsn = $dsn . "charset={$configuration['charset']}";

          $db = new PDO($dsn, $username, $password, array(
               // Por si no funciona correctamente al asignar el charset en el dsn
               PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$configuration['charset']}"
          ));
          $query = file_get_contents($filesPath . $fileName . ".sql");
          $stmt = $db->prepare($query);


          if ($stmt->execute()) {
               echo $message;
          } else {
               echo "Ha ocurrido un error ejecutando el archivo: ";
               print_r($stmt->errorInfo());
          }
     }

     private static function setup()
     {
          self::setupEnviroment();
     }

     // Permite utilizar las variables de entorno del proyecto
     private static function setupEnviroment()
     {
          require_once __DIR__ . '/../bootstrap/enviroment.php';
     }
}
