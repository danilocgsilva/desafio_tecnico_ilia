<?php

declare(strict_types=1);

namespace App\Data;

class PokemonData
{
    public function __construct(
        public readonly string $name,
        public readonly string $pokemonId,
        public readonly array $types,
        public readonly string $imageUrl,
    ) {}
}