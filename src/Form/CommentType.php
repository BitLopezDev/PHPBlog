<?php

namespace App\Form;

// use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Category;
use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

// use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentType extends AbstractType
{



    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
        ->add('content', TextAreaType::class, [
            'label' => 'Content of Comment',
            //'required' => false
        ])
            ->add('content', TextAreaType::class, [
                'label' => 'Content of Comment',
                //'required' => false
            ])
            ->add('sources', TextAreaType::class, [
                'label' => 'sources',
            ])

            ->add('Send', SubmitType::class, [
                'attr' => ['class' => 'btn-dark']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
            'csrf_protection' => true
            // 'csrf_protection' => false
            // 'csrf_field_name' => '_token_personalizado'
        ]);
    }
}