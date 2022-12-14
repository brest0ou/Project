<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('', name: 'main_')]
class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('main/about.html.twig');
    }

    #[Route('/store', name: 'store')]
    public function library(): Response
    {
        return $this->render('main/store.html.twig');
    }

    #[Route('cgu', name: 'cgu')]
    public function cgu(): Response
    {
        return $this->render('main/cgu.html.twig');
    }
}

