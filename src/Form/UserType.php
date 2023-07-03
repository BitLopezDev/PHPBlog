<?php

namespace App\Form;

// use App\Entity\Category;
use App\Entity\Users;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

// use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'User name',
                //'required' => false
            ])
            ->add('email', TextType::class, [
                'label' => 'Email address',
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone number',

            ])
            ->add('password', PasswordType::class, [
                'label' => 'password',

                //'required' => false
            ])->add('recovery_mail', TextType::class, [
                    'label' => 'Recovery Email',
                ])
            ->add('Send', SubmitType::class, [
                'attr' => ['class' => 'btn-dark']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
            // 'csrf_protection' => false
            // 'csrf_field_name' => '_token_personalizado'
        ]);
    }
}