<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/search', name:'search_')]
class SearchController extends AbstractController
{
    #[Route('', name: 'search')]
    public function index(): Response
    {
        
        
        return $this->render('search/search.html.twig');
    }
}
