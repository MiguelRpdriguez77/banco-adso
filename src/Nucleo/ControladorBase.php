<?php
declare(strict_types=1);

namespace App\Nucleo;

class ControladorBase
{
    protected function renderizar(string $vista, array $datos = []): void
    {
        extract($datos);
        $rutaVista = __DIR__ . "/../../vistas/{$vista}.php";
        $layout = __DIR__ . "/../../vistas/layout.php";

        if (file_exists($layout)) {
            require_once $layout;
        } else {
            if (file_exists($rutaVista)) {
                require_once $rutaVista;
            } else {
                exit("Vista no encontrada: {$vista}");
            }
        }
    }
}