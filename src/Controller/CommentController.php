<?php

namespace App\Controller;

use App\Entity\Post;
// use App\Controller\Post;
use App\Form\CommentType;
use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment/create/{postId}', name: 'comment_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, $postId): Response
    {
        $post = $entityManager->getRepository(Post::class)->find($postId);
        if (!$post) {
         throw $this->createNotFoundException('The post does not exist');
        }
        $comment = new Comment();
        $comment->setPost($post);

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());
            $entityManager->flush();

            $this->addFlash('success', 'Comentario guardado con éxito');
            return $this->redirectToRoute('comment_create', ['postId' => $postId]);
        }

        return $this->render('comment/create.html.twig', [
            'form' => $form->createView(),
            'post' => $post,
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