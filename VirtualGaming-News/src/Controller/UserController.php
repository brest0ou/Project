<?php

namespace App\Controller;

use App\Form\UserRegisterType;
use App\Entity\user;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user', name: 'user_')]
class UserController extends AbstractController
{
//  pour s'aider voir le cours ludoteck du pro pour la parti login/register/lougout = usercontroller.php
    #[Route('/login-register', name: 'login_register')]
    public function login(
        Request $request,
        UserRepository $userRepository
    ): Response {

        $user = new User();
        $form = $this->createForm(UserRegisterType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $userRepository->add($user, true);
            $this->addFlash('success', 'Compte créé');
            return $this->redirectToRoute('user_perso');
        }

        return $this->render('user/login_register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/perso', name: 'perso')]
    public function userInterface(): Response 
    {
        return $this->render('user/perso.html.twig');
    }
}
