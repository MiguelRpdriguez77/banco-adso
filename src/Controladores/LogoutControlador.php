<?php
declare(strict_types=1);

namespace App\Controladores;

class LogoutControlador
{
    public function index(): void
    {
        session_start();
        $_SESSION = [];
        session_destroy();
        header('Location: /login');
        exit;
    }
}