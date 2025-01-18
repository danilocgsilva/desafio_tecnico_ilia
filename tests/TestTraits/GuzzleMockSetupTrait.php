<?php

declare(strict_types=1);

namespace App\Tests\TestTraits;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client as GuzzleClient;

trait GuzzleMockSetupTrait
{
    use ResponseDataMockerTrait;
    
    private GuzzleClient $guzzleClient;
    
    public function setupGuzzleMockedListing($container)
    {
        $this->setupGuzzleMocked($container, "getMockedApiReturnListing", 200);
    }

    public function setupGuzzleMockedSingle($container)
    {
        $this->setupGuzzleMocked($container, "mockApiReturnSinglePokemon", 200);
    }

    public function setupGuzzleMockedNonExistant($container)
    {
        $this->setupGuzzleMocked($container, "mockApiReturnNonExistent", 404);
    }

    public function getMockedGuzzleClient(): GuzzleClient
    {
        return $this->guzzleClient;
    }

    private function setupGuzzleMocked($container, string $methodReturner, int $responseCode)
    {
        $mockResponse = new MockHandler([
            new Response($responseCode, [], json_encode($this->{$methodReturner}()))
        ]);

        $handlerStack = HandlerStack::create($mockResponse);

        $this->guzzleClient = new GuzzleClient(['handler' => $handlerStack]);

        $container->set(GuzzleClient::class, $this->guzzleClient);
    }
}
