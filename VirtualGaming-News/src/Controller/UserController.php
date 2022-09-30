<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user', name: 'user_')]
class UserController extends AbstractController
{

    #[Route('/login-register', name: 'login_register')]
    public function login(): Response
    {
        return $this->render('user/login_register.html.twig');
    }

    #[Route('/perso', name: 'perso')]
    public function userInterface(): Response 
    {
        return $this->render('user/perso.html.twig');
    }
}
