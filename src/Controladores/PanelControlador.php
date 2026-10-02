<?php
declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Repositorios\RepositorioCuentas;

class PanelControlador extends ControladorBase
{
    public function index(): void
    {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: /login');
            exit;
        }

        $repo = new RepositorioCuentas();
        $cuenta = $repo->obtenerPorId($_SESSION['cuenta_id']);
        $_SESSION['saldo'] = $cuenta['saldo'] ?? 0.00;

        $this->renderizar('panel', [
            'nombre' => $_SESSION['nombre'],
            'numero_cuenta' => $_SESSION['numero_cuenta'],
            'saldo' => $_SESSION['saldo']
        ]);
    }
}