<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repositories\PokemonsRepository;

final class PokemonTcgController extends AbstractController
{
    #[Route('/', name: 'app_pokemon_redirect')]
    public function home(): Response
    {
        return $this->redirectToRoute('app_pokemon_tcg');
    }

    #[Route('/pokemons', name: 'app_pokemon_tcg')]
    public function index(PokemonsRepository $pokemonsRepository): Response
    {
        return $this->render('pokemon_tcg/index.html.twig', [
            'pokemons' => $pokemonsRepository->get(),
        ]);
    }

    #[Route('/pokemons/{id}', name: 'app_pokemon_tcg_id')]
    public function show(PokemonsRepository $pokemonsRepository, $id): Response
    {
        $pokemon = $pokemonsRepository->getById($id);
        
        return $this->render('pokemon_tcg/show.html.twig', [
            'pokemon' => $pokemon
        ]);
    }
}
