<?php
declare(strict_types=1);

namespace App\Nucleo;

use PDO;
use PDOException;

class Conexion
{
    private static ?PDO $instancia = null;

    private function __construct() {}

    public static function obtenerInstancia(): PDO
    {
        if (self::$instancia === null) {
            $config = require __DIR__ . '/../../config/database.php';
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
            
            try {
                self::$instancia = new PDO($dsn, $config['usuario'], $config['clave'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                exit('Error de conexión a la base de datos: ' . $e->getMessage());
            }
        }

        return self::$instancia;
    }
}