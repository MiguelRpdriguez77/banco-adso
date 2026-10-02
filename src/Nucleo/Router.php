<?php
declare(strict_types=1);

namespace App\Nucleo;

class Router
{
    private array $rutas = [];

    public function registrar(string $ruta, string $controlador, string $accion): void
    {
        $this->rutas[$ruta] = [
            'controlador' => $controlador,
            'accion' => $accion
        ];
    }

    public function disparar(string $url): void
    {
        $urlParseada = parse_url($url, PHP_URL_PATH);
        $urlLimpia = rtrim($urlParseada, '/');
        if ($urlLimpia === '') {
            $urlLimpia = '/';
        }

        if (array_key_exists($urlLimpia, $this->rutas)) {
            $nombreControlador = $this->rutas[$urlLimpia]['controlador'];
            $accion = $this->rutas[$urlLimpia]['accion'];
            $claseControlador = "App\\Controladores\\{$nombreControlador}";

            if (class_exists($claseControlador)) {
                $instancia = new $claseControlador();
                if (method_exists($instancia, $accion)) {
                    $instancia->$accion();
                    return;
                }
                http_response_code(500);
                exit("Método {$accion} no encontrado en {$nombreControlador}");
            }
            http_response_code(500);
            exit("Controlador {$claseControlador} no encontrado");
        }

        http_response_code(404);
        echo "<h1>404 No encontrado</h1><p>La ruta solicitada no existe.</p>";
    }
}