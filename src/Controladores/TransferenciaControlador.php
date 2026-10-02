<?php
declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Repositorios\RepositorioCuentas;

class TransferenciaControlador extends ControladorBase
{
    public function index(): void
    {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /login');
            exit;
        }

        $mensaje = '';
        $error = '';
        $repo = new RepositorioCuentas();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cuentaDestinoNum = trim($_POST['cuenta_destino'] ?? '');
            $valor = (float)($_POST['valor'] ?? 0);
            $cuentaOrigen = $repo->obtenerPorId($_SESSION['cuenta_id']);
            $cuentaDestino = $repo->obtenerPorNumero($cuentaDestinoNum);

            if ($valor <= 0) {
                $error = 'Ingrese un monto válido para transferir.';
            } elseif (!$cuentaDestino) {
                $error = 'La cuenta de destino no existe.';
            } elseif ($cuentaOrigen['id'] === $cuentaDestino['id']) {
                $error = 'No puede transferir a su propia cuenta.';
            } elseif ($valor > $cuentaOrigen['saldo']) {
                $error = 'Fondos insuficientes para realizar la transferencia.';
            } else {
                if ($repo->registrarTransferencia($cuentaOrigen['id'], $cuentaDestino['id'], $valor)) {
                    $cuentaActualizada = $repo->obtenerPorId($_SESSION['cuenta_id']);
                    $_SESSION['saldo'] = $cuentaActualizada['saldo'];
                    $mensaje = "Transferencia exitosa de $" . number_format($valor, 2) . " a la cuenta {$cuentaDestinoNum}";
                } else {
                    $error = 'Error en la transacción.';
                }
            }
        }

        $this->renderizar('transferencia', ['mensaje' => $mensaje, 'error' => $error]);
    }
}