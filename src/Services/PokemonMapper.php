<?php

namespace App\Services;

use App\Data\PokemonData;
use stdClass;

class PokemonMapper
{
    public static function getPokemon(stdClass $rawData)
    {
        return new PokemonData(
            name: $rawData->name, 
            pokemonId: $rawData->id,
            types: $rawData->types,
            imageUrl: $rawData->images->small
        );
    }
}
