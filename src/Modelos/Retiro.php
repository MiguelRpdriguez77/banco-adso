<?php
declare(strict_types=1);

namespace App\Modelos;

class Retiro
{
    public function __construct(
        public int $id,
        public int $cuentaId,
        public float $valor,
        public string $fecha
    ) {}
}