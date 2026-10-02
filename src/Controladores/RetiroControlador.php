<?php
declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Repositorios\RepositorioCuentas;

class RetiroControlador extends ControladorBase
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
            $valor = (float)($_POST['valor'] ?? 0);
            $cuentaActual = $repo->obtenerPorId($_SESSION['cuenta_id']);

            if ($valor <= 0) {
                $error = 'Ingrese un monto válido para retirar.';
            } elseif ($valor > $cuentaActual['saldo']) {
                $error = 'Fondos insuficientes en la cuenta.';
            } else {
                $nuevoSaldo = $cuentaActual['saldo'] - $valor;
                if ($repo->actualizarSaldo($cuentaActual['id'], $nuevoSaldo) && $repo->registrarRetiro($cuentaActual['id'], $valor)) {
                    $_SESSION['saldo'] = $nuevoSaldo;
                    $mensaje = "Retiro exitoso de $" . number_format($valor, 2);
                } else {
                    $error = 'Ocurrió un error al procesar el retiro.';
                }
            }
        }

        $this->renderizar('retiro', ['mensaje' => $mensaje, 'error' => $error]);
    }
}