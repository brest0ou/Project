<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('/user', name: 'user_')]
class UserController extends AbstractController
{

    public function __construct(private UserRepository $userRepository)
    {

    }
//  pour s'aider voir le cours ludoteck du pro pour la parti login/register/lougout = usercontroller.php
    
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response {
        
        $error = $authenticationUtils->getLastAuthenticationError();   
        $lastUsername = $authenticationUtils->getLastUsername();
        dump($error);
        return $this->render('user/login.html.twig', [

            'last_username' => $lastUsername,
            'error'         => $error,

        ]);
       
    }
    
    #[Route('/{id}', name: 'perso', requirements: ["id" => "\d+"])]
    public function userInterface(User $user): Response 
    {
        
        return $this->render('user/perso.html.twig', ['user' => $user]);
        
    }
}
