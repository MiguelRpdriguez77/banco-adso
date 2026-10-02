<?php
declare(strict_types=1);

namespace App\Modelos;

class Cuenta
{
    public function __construct(
        public int $id,
        public string $numeroCuenta,
        public float $saldo,
        public int $clienteId
    ) {}
}