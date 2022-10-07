<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('', name: 'main_')]
class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(GameRepository $gamesRepository): Response
    {
        // recupérer tout mes jeux *array rand tableau
        $max = 3;
        $game = $gamesRepository->findAll();

        $arrayGame = [];
    
        for ($i = 0; $i < $max ; $i++)
        {
            $games = $game[array_rand($game)];
            
            array_push($arrayGame, $games);
            
        };
        
        return $this->render('main/index.html.twig', ['game' => $arrayGame]);
    }
    #[Route('/cgu', name: 'cgu')]
    public function cgu(): Response
    {
        return $this->render('main/cgu.html.twig');
    }
    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('main/about.html.twig');
    }

}