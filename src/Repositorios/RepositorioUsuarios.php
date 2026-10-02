<?php
declare(strict_types=1);

namespace App\Repositorios;

use App\Nucleo\Conexion;
use PDO;

class RepositorioUsuarios
{
    public function obtenerPorNumeroCuenta(string $numeroCuenta): ?array
    {
        $pdo = Conexion::obtenerInstancia();
        $stmt = $pdo->prepare("
            SELECT u.*, c.id as cuenta_id, c.numero_cuenta, c.saldo, cl.nombre as nombre_cliente 
            FROM usuarios u 
            JOIN cuentas c ON u.cuenta_id = c.id 
            JOIN clientes cl ON c.cliente_id = cl.id 
            WHERE c.numero_cuenta = ?
        ");
        $stmt->execute([$numeroCuenta]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        return $fila ?: null;
    }
}