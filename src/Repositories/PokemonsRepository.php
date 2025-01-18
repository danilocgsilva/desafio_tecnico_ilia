<?php

namespace App\Repositories;

use App\Data\PokemonData;
use GuzzleHttp\Client;
use stdClass;
use App\Services\PokemonMapper;

class PokemonsRepository
{
    /**
     * @return array<PokemonData>
     */
    public function get(): array
    {
        $client = new Client();
        $response = $client->request("GET", "https://api.pokemontcg.io/v2/cards");

        $objectContent = json_decode($response->getBody()->getContents());
        $dataArray = $objectContent->data;
        $dataArray = array_slice($dataArray, 0, 24);

        /**
         * @var array<PokemonData>
         */
        $pokemons = array_map(
            fn (stdClass $entry) => PokemonMapper::getPokemon($entry),
            $dataArray
        );

        return $pokemons;
    }
}
