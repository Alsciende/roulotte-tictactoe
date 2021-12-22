<?php

namespace App\Controller\Games;

use App\Controller\AbstractApiController;
use App\Repository\GameRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListGamesController extends AbstractApiController
{
    private GameRepository $repository;

    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/games', name: 'list_games', methods: ['GET'], format: 'json')]
    public function __invoke(): Response
    {
        $games = $this->repository->findAll();

        return new Response(
            $this->serializer->serialize($games, 'json')
        );
    }
}
