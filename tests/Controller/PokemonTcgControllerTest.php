<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\TestTraits\GuzzleMockSetupTrait;

final class PokemonTcgControllerTest extends WebTestCase
{
    use GuzzleMockSetupTrait;

    private static $httpClient;

    public function setUp(): void
    {
        parent::setUp();
        self::$httpClient = static::createClient();
    }

    public function testHome(): void
    {
        self::$httpClient->request('GET', '/');

        self::assertResponseRedirects();
    }

    public function testIndex(): void
    {
        $container = static::getContainer();

        $this->setupGuzzleMockedListing($container);

        self::$httpClient->request('GET', '/pokemons');

        self::assertResponseIsSuccessful();
    }

    public function testShow(): void
    {
        $container = static::getContainer();

        $this->setupGuzzleMockedSingle($container);

        self::$httpClient->request('GET', '/pokemons/dp3-1');

        self::assertResponseIsSuccessful();
    }
}
