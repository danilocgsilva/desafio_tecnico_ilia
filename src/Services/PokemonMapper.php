<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\PokemonData;
use App\Data\PokemonDataFull;
use App\Data\ResistenciaData;
use App\Data\AtaqueData;
use stdClass;

class PokemonMapper
{
    public static function getPokemonShortened(stdClass $rawData): PokemonData
    {
        return new PokemonData(
            name: $rawData->name, 
            pokemonId: $rawData->id,
            types: $rawData->types,
            imageUrl: $rawData->images->small
        );
    }

    public static function getPokemonFull(stdClass $rawData): PokemonDataFull
    {
        return new PokemonDataFull(
            name: $rawData->name, 
            pokemonId: $rawData->id,
            types: $rawData->types,
            imageUrl: $rawData->images->large,
            resistencias: array_map(
            fn (stdClass $entry) => self::getResistencia($entry),
            $rawData->resistances ?? []
            ),
            fraquezas: array_map(
                fn (stdClass $entry) => self::getResistencia($entry),
                $rawData->weaknesses ?? []
            ),
            ataques: array_map(
                fn (stdClass $entry) =>  self::getAttaque($entry), 
                $rawData->attacks ?? []
            )
        );
    }

    public static function getResistencia(stdClass $rawData): ResistenciaData
    {
        return new ResistenciaData(
            tipo: $rawData->type,
            valor: $rawData->value,
        );
    }

    public static function getAttaque(stdClass $rawData)
    {
        return new AtaqueData(
            nome: $rawData->name,
            dano: $rawData->damage
        );
    }
}
