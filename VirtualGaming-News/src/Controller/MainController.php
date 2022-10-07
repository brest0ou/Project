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
    public function index(CategoryRepository $categoryRepository, GameRepository $gameRepository,PostRepository $postRepository): Response
    {
        // recupérer tout mes jeux *array rand tableau
        $category = $categoryRepository->findAll();
        $games = $gameRepository->findAll();
        $post = $postRepository->findAll();
        
        return $this->render('main/index.html.twig',[
            
            'category' => $category, 'game' => $games, 'post' => $post]);

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