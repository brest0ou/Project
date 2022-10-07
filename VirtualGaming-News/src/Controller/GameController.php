<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Post;
use App\Form\GameRegisterType;
use App\Form\PostRegisterType;
use App\Services\imageUploader;
use App\Repository\GameRepository;
use App\Repository\PostRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/game', name:'game_')]
class GameController extends AbstractController
{
    public function __construct(private GameRepository $gameRepository, )
    {
        
    }
    
    #[Route('/{id}', name: 'games', requirements: ["id" => "\d+"])]
    public function game(Game $game  ,Request $request, PostRepository $PostRepository,imageUploader $imageUploader): Response
    {
        $post = new Post();

        $form = $this->createForm(PostRegisterType::class , $post );
        $form->handleRequest($request);
        // if methode render
        if ($form->isSubmitted() && $form->isValid()) 
        {
            //  controller pour les images

             $files = $form->get('picture')->getData();
             if ($files) {
                 $FileName = $imageUploader->upload($files);
                 $game->setPicture($FileName);
             }

            // créer des post et les affiché sur la page qui concerne le jeux

             $PostRepository->add($post, $game->getId(), true);
            
        }
        $posts = $PostRepository->findBy([ 'gamesPosts' => $game]); //->getId()
        
        return $this->render('game/game.html.twig', [
            'game' => $game , 'category' => $game->getGamesCategory()[0],  'form' => $form->createView(), 'post' => $posts,
        ]);
        
    }
    
    #[Route('/library', name: 'library')]
    public function library(CategoryRepository $categoryRepository, GameRepository $gameRepository): Response
    {
        $category = $categoryRepository->findAll();
        $games = $gameRepository->findAll();
        
        return $this->render('game/library.html.twig',['category' => $category, 'game' => $games]);
        
            // diogo category


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
            
            return $this->redirectToRoute('game_games', [
                'id' => $game->getId(),
            ]);
           
        }
        
        return $this->render('game/download.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
