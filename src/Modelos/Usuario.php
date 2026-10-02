<?php
declare(strict_types=1);

namespace App\Modelos;

class Usuario
{
    public function __construct(
        public int $id,
        public int $cuentaId,
        public string $claveHash
    ) {}
}