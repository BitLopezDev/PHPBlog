<?php

namespace App\Controller;


use App\Form\UserType;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user/create', name: 'user_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());
            $entityManager->flush();

            $this->addFlash('success', 'Publicación guardada con éxito');
            return $this->redirectToRoute('user_create');
        }

        return $this->render('user/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user/{id}/editar', name: 'user_edit', methods: ['GET', 'POST'])]
    public function edit(Users $user, Request $request, EntityManagerInterface $entityManager): Response
    {
        // dd($user);
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $entityManager->persist($form->getData()); línea opcional...
            $entityManager->flush();

            $this->addFlash('success', 'Publicación editada con éxito');
            return $this->redirectToRoute('user_edit', [
                'id' => $user->getId()
            ]);
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}