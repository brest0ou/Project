<?php

namespace App\Controller;
use App\Form\GameRegisterType;
use App\Repository\GameRepository;
use App\Repository\PostRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('', name: 'main_')]
class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(Request $request,PostRepository $postRepository, GameRepository $gamesRepository): Response
    {
        // recupérer tout mes jeux *array rand tableau
        $max = 3;
        $game = $gamesRepository->findAll();
        $post = $postRepository->findAll();

        $arrayGame = [];
        $arrayPost = [];
    
        for ($i = 0; $i < $max ; $i++)
        {

            $games = $game[array_rand($game)];
            $posts = $post[array_rand($post)];
            array_push($arrayGame, $games);
            array_push($arrayPost, $post);
        };

        $gameName = $request->get('search-game');
        $gamesRepo = $gamesRepository->findAll();
        
        $gamesTest = $gamesRepo[1];
        // dump($gamesTest->getName());
        // dump($gamesTest->getId());

        foreach ($gamesRepo as $key => $value)
        {
            // dump($value->getName());
            // dump($value->getId());
            
            if($gameName == $value->getName())
            {
                // $gamesRepo = $gamesRepository->find($gameName);
                
                return $this->redirectToRoute('game_games',['id' => $value->getId()]);
            }        
        }
    
        
       

        return $this->render('main/index.html.twig', ['game' => $arrayGame, 'post' => $arrayPost]);
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