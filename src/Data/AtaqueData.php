<?php

declare(strict_types=1);

namespace App\Data;

class AtaqueData
{
    public function __construct(
        public readonly string $nome,
        public readonly string $dano,
    ) {}
}
