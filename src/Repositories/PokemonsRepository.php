<?php

namespace App\Repositories;

use App\Data\{PokemonData, PokemonDataFull};
use GuzzleHttp\Client;
use stdClass;
use App\Services\PokemonMapper;

class PokemonsRepository
{
    private Client $client;

    const ENDERECO_API = "https://api.pokemontcg.io";
    
    public function __construct()
    {
        $this->client = new Client();
    }
    
    /**
     * @return array<PokemonData>
     */
    public function get(): array
    {
        $response = $this->client->request("GET", self::ENDERECO_API . "/v2/cards");
        $objectContent = json_decode($response->getBody()->getContents());
        $dataArray = $objectContent->data;

        /**
         * @var array<PokemonData>
         */
        $pokemons = array_map(
            fn (stdClass $entry) => PokemonMapper::getPokemonShortened($entry),
            $dataArray
        );

        return $pokemons;
    }

    public function getById(string $id): PokemonDataFull
    {
        $response = $this->client->request("GET", self::ENDERECO_API . "/v2/cards/" . $id);
        $objectContent = json_decode($response->getBody()->getContents());
        $pokemonData = $objectContent->data;

        return PokemonMapper::getPokemonFull($pokemonData);
    }
}
