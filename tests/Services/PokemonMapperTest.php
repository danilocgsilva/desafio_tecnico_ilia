<?php

namespace App\Tests\Services;

use PHPUnit\Framework\TestCase;
use App\Services\PokemonMapper;
use App\Tests\TestTraits\ResponseDataMockerTrait;
use App\Data\PokemonDataFull;
use App\Data\PokemonData;

class PokemonMapperTest extends TestCase
{
    use ResponseDataMockerTrait;

    public function testGetPokemonFull(): void
    {
        $rawListingData = $this->mockApiReturnSinglePokemon()->data;
        
        $pokemonFullData = PokemonMapper::getPokemonFull($rawListingData);

        $this->assertInstanceOf(PokemonDataFull::class, $pokemonFullData);

        $this->assertSame("Ampharos", $pokemonFullData->name);
    }

    public function testGetPokemonShortened(): void
    {
        $fragmentDataFromApi = $this->mockApiReturnFragment();
        
        $pokemonData = PokemonMapper::getPokemonShortened($fragmentDataFromApi);

        $this->assertInstanceOf(PokemonData::class, $pokemonData);

        $this->assertSame("Ampharos", $pokemonData->name);
    }

    public function testGetPokemonShortenedDifferentName(): void
    {
        $fragmentDataFromApi = $this->mockApiReturnFragment(name: "Snivy");
        
        $pokemonData = PokemonMapper::getPokemonShortened($fragmentDataFromApi);

        $this->assertInstanceOf(PokemonData::class, $pokemonData);

        $this->assertSame("Snivy", $pokemonData->name);
    }
}
