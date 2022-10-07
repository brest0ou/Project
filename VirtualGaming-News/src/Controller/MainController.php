<?php

namespace App\Controller;
use App\Repository\GameRepository;
use App\Repository\PostRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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