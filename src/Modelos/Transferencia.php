<?php
declare(strict_types=1);

namespace App\Modelos;

class Transferencia
{
    public function __construct(
        public int $id,
        public int $cuentaOrigenId,
        public int $cuentaDestinoId,
        public float $valor,
        public string $fecha
    ) {}
}