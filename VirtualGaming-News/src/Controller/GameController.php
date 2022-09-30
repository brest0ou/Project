<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/game', name:'game_')]
class GameController extends AbstractController
{
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
    public function download(): Response
    {
        return $this->render('game/download.html.twig');
    }

}
