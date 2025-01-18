<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repositories\PokemonsRepository;

final class PokemonTcgController extends AbstractController
{
    #[Route('/', name: 'app_pokemon_tcg')]
    public function index(PokemonsRepository $pokemonsRepository): Response
    {
        return $this->render('pokemon_tcg/index.html.twig', [
            'pokemons' => $pokemonsRepository->get(),
        ]);
    }
}
