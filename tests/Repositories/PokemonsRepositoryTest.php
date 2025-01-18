<?php

namespace App\Tests\Repositories;

use App\Repositories\PokemonsRepository;
use App\Tests\TestTraits\GuzzleMockSetupTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Data\PokemonData;
use App\Data\PokemonDataFull;
use GuzzleHttp\Exception\ClientException;

class PokemonsRepositoryTest extends KernelTestCase
{
    use GuzzleMockSetupTrait;

    public function testGetPockemonsListing(): void
    {
        $container = static::getContainer();

        $this->setupGuzzleMockedListing($container);

        $pokemonsRepository = new PokemonsRepository($this->getMockedGuzzleClient());

        $pokemons = $pokemonsRepository->get();
        $this->assertIsArray($pokemons);

        /* @var $pokemons \App\Data\PokemonData[] */
        foreach ($pokemons as $pokemonData) {
            $this->assertInstanceOf(PokemonData::class, $pokemonData);
        }
    }

    public function testGetById(): void
    {
        $container = static::getContainer();

        $this->setupGuzzleMockedSingle($container);

        $pokemonsRepository = new PokemonsRepository($this->getMockedGuzzleClient());

        $singlePokemon = $pokemonsRepository->getById("dp3-1");
        $this->assertInstanceOf(PokemonDataFull::class, $singlePokemon);
    }

    public function testGetByIdAndCheckName(): void
    {
        $container = static::getContainer();

        $this->setupGuzzleMockedSingle($container);

        $pokemonsRepository = new PokemonsRepository($this->getMockedGuzzleClient());

        $singlePokemon = $pokemonsRepository->getById("dp3-1");
        $this->assertSame("Ampharos", $singlePokemon->name);
    }

    public function testGetByNonExistingId(): void
    {
        $this->expectException(ClientException::class);
        
        $container = static::getContainer();

        $this->setupGuzzleMockedNonExistant($container);

        $pokemonsRepository = new PokemonsRepository($this->getMockedGuzzleClient());

        $pokemonsRepository->getById("abc1234");
    }
}
