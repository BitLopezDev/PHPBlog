<?php

namespace App\Controller;


use App\Form\CommentType;
use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment/create', name: 'comment_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommentType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());
            $entityManager->flush();

            $this->addFlash('success', 'Publicación guardada con éxito');
            return $this->redirectToRoute('comment_create');
        }

        return $this->render('comment/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/comment/{id}/editar', name: 'comment_edit', methods: ['GET', 'POST'])]
    public function edit(Comment $comment, Request $request, EntityManagerInterface $entityManager): Response
    {
        // dd($comment);
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $entityManager->persist($form->getData()); línea opcional...
            $entityManager->flush();

            $this->addFlash('success', 'Publicación editada con éxito');
            return $this->redirectToRoute('comment_edit', [
                'id' => $comment->getId()
            ]);
        }

        return $this->render('comment/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}