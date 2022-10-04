<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use App\Form\GameRegisterType;
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
    #[Route('', name: 'game')]
    public function index(): Response
    {
        return $this->render('game/game.html.twig');
    }

    
    #[Route('/library', name: 'library')]
    public function library(): Response
    {
        return $this->render('game/library.html.twig');
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

            $this->addFlash('success', 'Jeu sauvegardé !');
            return $this->redirectToRoute('game_game', [
                'id' => $game->getId(),
            ]);
        }
        
        return $this->render('game/download.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
