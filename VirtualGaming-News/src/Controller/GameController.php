<?php

namespace App\Controller;


use App\Entity\Game;
use App\Entity\Post;
use App\Repository\GameRepository;
use App\Repository\CategoryRepository;
use App\Services\imageUploader;
use App\Form\GameRegisterType;
use App\Form\PostRegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/game', name:'game_')]
class GameController extends AbstractController
{
    public function __construct(private GameRepository $gameRepository)
    {
        
    }
    
    #[Route('/{id}', name: 'games', requirements: ["id" => "\d+"])]
    public function game(Game $game  ,Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostRegisterType::class , $post );
        $form->handleRequest($request);
        
        return $this->render('game/game.html.twig', [
            'game' => $game , 'category' => $game->getGamesCategory()[0],  'form' => $form->createView(),
        ]);
    }
    
    #[Route('/library', name: 'library')]
    public function library(CategoryRepository $categoryRepository, GameRepository $gameRepository): Response
    {
        $category = $categoryRepository->findBy([],['name' => 'ASC']);
        $games = $gameRepository->findAll();
        return $this->render('game/library.html.twig',['category' => $category, 'game' => $games]);
    }


    #[Route('/download', name: 'download')]
    public function download(Request $request, imageUploader $imageUploader): Response
    {
        $game= new Game();
        $form = $this->createForm(GameRegisterType::class, $game);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            // controller pour les images
            $files = $form->get('picture')->getData();
            if ($files) {
                $FileName = $imageUploader->upload($files);
                $game->setPicture($FileName);
            }

            $this->gameRepository->add($game, true);

            $this->addFlash('success', 'Jeu sauvegardé !');
            return $this->redirectToRoute('game_games', [
                'id' => $game->getId(),
            ]);
        }
       
        return $this->render('game/download.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
