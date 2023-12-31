<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class PostController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/post/create', name: 'post_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());
            $entityManager->flush();

            $this->addFlash('success', 'Publicación guardada con éxito');
            return $this->redirectToRoute('post_create');
        }

        return $this->render('post/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/post/{id}/blog', name: 'post_blog', methods: ['GET'])]
    public function blog(EntityManagerInterface $entityManager, $id): Response
    {
        
        $post = $entityManager->getRepository(Post::class)->find($id);
        if ($post === null) {
            throw $this->createNotFoundException('The post does not exist');

        }
        $comments = $post->getComments();
        return $this->render('post/blog.html.twig', [
            'posts' => $post,
            'comments' => $comments
        ]);


    }

    #[Route('/post/{id}/comments', name: 'post_comments', methods: ['GET'])]
    public function comments(EntityManagerInterface $entityManager, $id): Response
    {
        $post = $entityManager->getRepository(Post::class)->find($id);
        if ($post === null) {
            dd($post);
        }
        $comments = $post->getComments();



        return $this->render('post/blog.html.twig', [
            'comments' => $comments
        ]);
    }

    #[Route('/post/{id}/editar', name: 'post_edit', methods: ['GET', 'POST'])]

    public function edit(Post $post, Request $request, EntityManagerInterface $entityManager): Response
    {
        // dd($post);
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $entityManager->persist($form->getData()); línea opcional...
            $entityManager->flush();

            $this->addFlash('success', 'Publicación editada con éxito');
            return $this->redirectToRoute('post_edit', [
                'id' => $post->getId()
            ]);
        }

        return $this->render('post/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}