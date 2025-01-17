<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PokemonTcgController extends AbstractController
{
    #[Route('/', name: 'app_pokemon_tcg')]
    public function index(): Response
    {
        return $this->render('pokemon_tcg/index.html.twig', [
            'controller_name' => 'PokemonTcgController',
        ]);
    }
}
