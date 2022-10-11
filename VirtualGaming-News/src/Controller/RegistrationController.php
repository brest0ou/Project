<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegisterType;
use App\Services\imageUploader;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserRepository $userRepository,
    imageUploader $imageUploader,): Response
    {

        $user = new User();
        $form = $this->createForm(UserRegisterType::class, $user);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password

            $user->setPassword(

                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )

            );
           
            
            $file = $form->get('picture')->getData();
            if ($file) {
                $FileName = $imageUploader->upload($file);
                $user->setPicture($FileName);
            }
            
            $this->addFlash('success', 'Compte créé');
            $userRepository->add($user, true);
            return $this->redirectToRoute('user_perso',['id' => $user->getId(),]);

        }

        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}