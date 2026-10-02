<?php
declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\ControladorBase;
use App\Repositorios\RepositorioUsuarios;

class LoginControlador extends ControladorBase
{
    public function index(): void
    {
        session_start();
        if (isset($_SESSION['usuario_id'])) {
            header('Location: /panel');
            exit;
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numeroCuenta = trim($_POST['numero_cuenta'] ?? '');
            $clave = $_POST['clave'] ?? '';

            $repo = new RepositorioUsuarios();
            $datosUsuario = $repo->obtenerPorNumeroCuenta($numeroCuenta);

            if ($datosUsuario && password_verify($clave, $datosUsuario['clave_hash'])) {
                session_regenerate_id(true);
                $_SESSION['usuario_id'] = (int)$datosUsuario['id'];
                $_SESSION['cuenta_id'] = (int)$datosUsuario['cuenta_id'];
                $_SESSION['nombre'] = $datosUsuario['nombre_cliente'];
                $_SESSION['numero_cuenta'] = $datosUsuario['numero_cuenta'];
                $_SESSION['saldo'] = $datosUsuario['saldo'];

                header('Location: /panel');
                exit;
            }
            $error = 'Número de cuenta o contraseña incorrectos';
        }

        $this->renderizar('login', ['error' => $error]);
    }
}