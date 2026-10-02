<?php
declare(strict_types=1);

namespace App\Repositorios;

use App\Nucleo\Conexion;
use PDO;

class RepositorioCuentas
{
    public function obtenerPorId(int $id): ?array
    {
        $pdo = Conexion::obtenerInstancia();
        $stmt = $pdo->prepare("SELECT * FROM cuentas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function obtenerPorNumero(string $numero): ?array
    {
        $pdo = Conexion::obtenerInstancia();
        $stmt = $pdo->prepare("SELECT * FROM cuentas WHERE numero_cuenta = ?");
        $stmt->execute([$numero]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function actualizarSaldo(int $cuentaId, float $nuevoSaldo): bool
    {
        $pdo = Conexion::obtenerInstancia();
        $stmt = $pdo->prepare("UPDATE cuentas SET saldo = ? WHERE id = ?");
        return $stmt->execute([$nuevoSaldo, $cuentaId]);
    }

    public function registrarRetiro(int $cuentaId, float $valor): bool
    {
        $pdo = Conexion::obtenerInstancia();
        $stmt = $pdo->prepare("INSERT INTO retiros (cuenta_id, valor, fecha) VALUES (?, ?, NOW())");
        return $stmt->execute([$cuentaId, $valor]);
    }

    public function registrarTransferencia(int $origenId, int $destinoId, float $valor): bool
    {
        $pdo = Conexion::obtenerInstancia();
        try {
            $pdo->beginTransaction();

            $stmt1 = $pdo->prepare("UPDATE cuentas SET saldo = saldo - ? WHERE id = ?");
            $stmt1->execute([$valor, $origenId]);

            $stmt2 = $pdo->prepare("UPDATE cuentas SET saldo = saldo + ? WHERE id = ?");
            $stmt2->execute([$valor, $destinoId]);

            $stmt3 = $pdo->prepare("INSERT INTO transferencias (cuenta_origen_id, cuenta_destino_id, valor, fecha) VALUES (?, ?, ?, NOW())");
            $stmt3->execute([$origenId, $destinoId, $valor]);

            $pdo->commit();
            return true;
        } catch (\Exception $e) {
            $pdo->rollBack();
            return false;
        }
    }
}