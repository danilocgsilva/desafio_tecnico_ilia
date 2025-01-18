<?php

declare(strict_types=1);

namespace App\Data;

class FraquezasData
{
    public function __construct(
        public readonly string $tipo,
        public readonly string $valor,
    ) {}
}
