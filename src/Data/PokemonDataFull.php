<?php

declare(strict_types=1);

namespace App\Data;

class PokemonDataFull
{
    /**
     * Summary of __construct
     * @param string $name
     * @param string $pokemonId
     * @param array $types
     * @param string $imageUrl
     * @param array<\App\Data\ResistenciaData> $resistencias
     * @param array<\App\Data\FraquezasData> $fraquezas
     * @param array $ataques<App\Data\AtaqueData>
     */
    public function __construct(
        public readonly string $name,
        public readonly string $pokemonId,
        public readonly array $types,
        public readonly string $imageUrl,
        public readonly array $resistencias,
        public readonly array $fraquezas,
        public readonly array $ataques,
    ) {}
}