<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;
use stdClass;

final class PokemonTcgControllerTest extends WebTestCase
{
    public function testHome(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        self::assertResponseRedirects();
    }

    public function testIndex(): void
    {
        $client = static::createClient();

        $container = static::getContainer();

        $mockResponse = new MockHandler([
            new Response(200, [], json_encode($this->getMockedApiReturn()))
        ]);

        $handlerStack = HandlerStack::create($mockResponse);

        $guzzleClient = new Client(['handler' => $handlerStack]);

        $container->set(Client::class, $guzzleClient);

        $client->request('GET', '/pokemons');

        self::assertResponseIsSuccessful();
    }

    private function getMockedApiReturn(): stdClass
    {
        $rawReturnString = <<<EOF
        {
            "data": [
                {
                    "id": "dp3-1",
                    "name": "Ampharos",
                    "supertype": "Pokémon",
                    "subtypes": [
                        "Stage 2"
                    ],
                    "level": "52",
                    "hp": "130",
                    "types": [
                        "Lightning"
                    ],
                    "evolvesFrom": "Flaaffy",
                    "abilities": [
                        {
                            "name": "Jamming",
                            "text": "After your opponent plays a Supporter card from his or her hand, put 1 damage counter on each of your opponent's Pokémon. You can't use more than 1 Jamming Poké-Body each turn.",
                            "type": "Poké-Body"
                        }
                    ],
                    "attacks": [
                        {
                            "name": "Cluster Bolt",
                            "cost": [
                                "Lightning",
                                "Colorless",
                                "Colorless"
                            ],
                            "convertedEnergyCost": 3,
                            "damage": "70",
                            "text": "You may discard all Lightning Energy attached to Ampharos. If you do, this attack does 20 damage to each of your opponent's Benched Pokémon that has any Energy cards attached to it. (Don't apply Weakness and Resistance for Benched Pokémon.)"
                        }
                    ],
                    "weaknesses": [
                        {
                            "type": "Fighting",
                            "value": "+30"
                        }
                    ],
                    "resistances": [
                        {
                            "type": "Metal",
                            "value": "-20"
                        }
                    ],
                    "retreatCost": [
                        "Colorless",
                        "Colorless",
                        "Colorless"
                    ],
                    "convertedRetreatCost": 3,
                    "set": {
                        "id": "dp3",
                        "name": "Secret Wonders",
                        "series": "Diamond & Pearl",
                        "printedTotal": 132,
                        "total": 132,
                        "legalities": {
                            "unlimited": "Legal"
                        },
                        "ptcgoCode": "SW",
                        "releaseDate": "2007/11/01",
                        "updatedAt": "2018/03/04 10:35:00",
                        "images": {
                            "symbol": "https://images.pokemontcg.io/dp3/symbol.png",
                            "logo": "https://images.pokemontcg.io/dp3/logo.png"
                        }
                    },
                    "number": "1",
                    "artist": "Kouki Saitou",
                    "rarity": "Rare Holo",
                    "flavorText": "The tip of its tail shines brightly. In the olden days, people sent signals using the tail's light.",
                    "nationalPokedexNumbers": [
                        181
                    ],
                    "legalities": {
                        "unlimited": "Legal"
                    },
                    "images": {
                        "small": "https://images.pokemontcg.io/dp3/1.png",
                        "large": "https://images.pokemontcg.io/dp3/1_hires.png"
                    },
                    "tcgplayer": {
                        "url": "https://prices.pokemontcg.io/tcgplayer/dp3-1",
                        "updatedAt": "2025/01/18",
                        "prices": {
                            "holofoil": {
                                "low": 5.08,
                                "mid": 11.21,
                                "high": 44.99,
                                "market": 14.75,
                                "directLow": null
                            },
                            "reverseHolofoil": {
                                "low": 3.27,
                                "mid": 7.72,
                                "high": 11.97,
                                "market": 9.32,
                                "directLow": null
                            }
                        }
                    },
                    "cardmarket": {
                        "url": "https://prices.pokemontcg.io/cardmarket/dp3-1",
                        "updatedAt": "2025/01/18",
                        "prices": {
                            "averageSellPrice": 1.47,
                            "lowPrice": 0.1,
                            "trendPrice": 1.68,
                            "germanProLow": 0.0,
                            "suggestedPrice": 0.0,
                            "reverseHoloSell": 2.48,
                            "reverseHoloLow": 0.29,
                            "reverseHoloTrend": 2.37,
                            "lowPriceExPlus": 1.0,
                            "avg1": 2.53,
                            "avg7": 1.93,
                            "avg30": 1.7,
                            "reverseHoloAvg1": 7.0,
                            "reverseHoloAvg7": 2.83,
                            "reverseHoloAvg30": 2.42
                        }
                    }
                },
                {
                    "id": "ex12-1",
                    "name": "Aerodactyl",
                    "supertype": "Pokémon",
                    "subtypes": [
                        "Stage 1"
                    ],
                    "hp": "70",
                    "types": [
                        "Colorless"
                    ],
                    "evolvesFrom": "Mysterious Fossil",
                    "abilities": [
                        {
                            "name": "Reactive Protection",
                            "text": "Any damage done to Aerodactyl by attacks from your opponent's Pokémon is reduced by 10 for each React Energy card attached to Aerodactyl (after applying Weakness and Resistance).",
                            "type": "Poké-Body"
                        }
                    ],
                    "attacks": [
                        {
                            "name": "Power Blow",
                            "cost": [
                                "Colorless"
                            ],
                            "convertedEnergyCost": 1,
                            "damage": "10+",
                            "text": "Does 10 damage plus 10 more damage for each Energy attached to Aerodactyl."
                        },
                        {
                            "name": "Speed Stroke",
                            "cost": [
                                "Colorless",
                                "Colorless",
                                "Colorless"
                            ],
                            "convertedEnergyCost": 3,
                            "damage": "40",
                            "text": "During your opponent's next turn, prevent all effects, including damage, done to Aerodactyl by attacks from your opponent's Pokémon-ex."
                        }
                    ],
                    "weaknesses": [
                        {
                            "type": "Lightning",
                            "value": "×2"
                        }
                    ],
                    "resistances": [
                        {
                            "type": "Fighting",
                            "value": "-30"
                        }
                    ],
                    "set": {
                        "id": "ex12",
                        "name": "Legend Maker",
                        "series": "EX",
                        "printedTotal": 92,
                        "total": 93,
                        "legalities": {
                            "unlimited": "Legal"
                        },
                        "ptcgoCode": "LM",
                        "releaseDate": "2006/02/01",
                        "updatedAt": "2018/03/04 10:35:00",
                        "images": {
                            "symbol": "https://images.pokemontcg.io/ex12/symbol.png",
                            "logo": "https://images.pokemontcg.io/ex12/logo.png"
                        }
                    },
                    "number": "1",
                    "artist": "Hajime Kusajima",
                    "rarity": "Rare Holo",
                    "nationalPokedexNumbers": [
                        142
                    ],
                    "legalities": {
                        "unlimited": "Legal"
                    },
                    "images": {
                        "small": "https://images.pokemontcg.io/ex12/1.png",
                        "large": "https://images.pokemontcg.io/ex12/1_hires.png"
                    },
                    "tcgplayer": {
                        "url": "https://prices.pokemontcg.io/tcgplayer/ex12-1",
                        "updatedAt": "2025/01/18",
                        "prices": {
                            "holofoil": {
                                "low": 11.0,
                                "mid": 16.51,
                                "high": 39.99,
                                "market": 21.36,
                                "directLow": 23.99
                            },
                            "reverseHolofoil": {
                                "low": 19.0,
                                "mid": 28.99,
                                "high": 99.99,
                                "market": 32.86,
                                "directLow": 99.99
                            }
                        }
                    },
                    "cardmarket": {
                        "url": "https://prices.pokemontcg.io/cardmarket/ex12-1",
                        "updatedAt": "2025/01/18",
                        "prices": {
                            "averageSellPrice": 8.98,
                            "lowPrice": 1.98,
                            "trendPrice": 9.9,
                            "germanProLow": 0.0,
                            "suggestedPrice": 0.0,
                            "reverseHoloSell": 21.0,
                            "reverseHoloLow": 4.75,
                            "reverseHoloTrend": 13.15,
                            "lowPriceExPlus": 7.0,
                            "avg1": 6.85,
                            "avg7": 8.32,
                            "avg30": 9.63,
                            "reverseHoloAvg1": 9.5,
                            "reverseHoloAvg7": 13.37,
                            "reverseHoloAvg30": 24.38
                        }
                    }
                }
            ]
        }
        EOF;

        $rawObject = json_decode($rawReturnString);

        return $rawObject;
    }
}
