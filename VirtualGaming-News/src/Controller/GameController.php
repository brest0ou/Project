<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Post;
use App\Entity\Category;
use App\Form\GameRegisterType;
use App\Form\PostRegisterType;
use App\Repository\GameRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/game', name:'game_')]
class GameController extends AbstractController
{
    public function __construct(private GameRepository $gameRepository, CategoryRepository $categoryRepository)
    {
        
    }
    
    #[Route('/{id}', name: 'games', requirements: ["id" => "\d+"])]
    public function game(Game $game ,Category $category, Request $request): Response
    {
        
        $post = new Post();
        $form = $this->createForm(PostRegisterType::class , $post );

        $form->handleRequest($request);
        
        
        
        return $this->render('game/game.html.twig', [
            'game' => $game, 'category' => $category, 'form' => $form->createView(),
        ]);
    }
    
    #[Route('/library', name: 'library')]
    public function library(CategoryRepository $categoryRepository): Response
    {
        //$category = $categoryRepository->findBy(array('id' => [0,1,2,3,4,5,6,7,8]));
        $category = $categoryRepository->findBy([],['name' => 'ASC']);
        
        return $this->render('game/library.html.twig',['category' => $category,]);
    }


    #[Route('/download', name: 'download')]
    public function download(Request $request): Response
    {
        
        
        $game= new Game();
        
        $form = $this->createForm(GameRegisterType::class, $game);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $this->gameRepository->add($game, true);
            
            return $this->redirectToRoute('game_games', [
                'id' => $game->getId(),
            ]);
           
        }
        
        return $this->render('game/download.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
