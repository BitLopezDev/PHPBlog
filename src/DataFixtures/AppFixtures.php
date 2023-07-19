<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\PostFactory;
use App\Factory\CommentFactory;
use App\Factory\CategoryFactory;
use App\Factory\UsersFactory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $post = new Post();

        // $post->setTitle('Post de Prueba');
        // $post->setBody('Cuerpo de Prueba');
        // $post->setAvance('Avance de Prueba');

        // $post->setDate('11/6/2012');

        // $category = new Category();
        // $category->setName('Random');
        // $manager->persist($category);

        // $post->setCategory($category);
        // $manager->persist($post);

        // $user = new Users();
        // $user->setUsername('Santiago');
        // $user->setEmail('contacto@bitlopez.bio');
        // $user->setPhone('526857');
        // $user->setPassword('qwerty');
        // $user->setTotp(('1111111'));
        // $user->setRecoveryMail('otromail@mail');
        // $manager->persist($user);

        // $comment = new Comment();
        // $comment->setContent('Contenido del comentario');
        // $comment->addAuthor($user);
        // $comment->setPost($post);
        // $user->addComment($comment);
        // $manager->persist($comment);
        CategoryFactory::createMany(5);
        PostFactory::createMany(150);
        CommentFactory::createMany(700);
        UsersFactory::createMany(5);




        $manager->flush();
    }
}