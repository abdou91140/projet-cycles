<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('old_password', PasswordType::class,[
                'label'=>'Mon mot de passe actuel',
                'mapped'=>false,
                'attr'=>[
                    'placeholder'=>"Veuillez saisir votre mot de passe actuel"
                ]
            ])
            ->add('new_password', RepeatedType::class,
                ['type' => PasswordType::class,
                    'mapped'=>false,
                    'invalid_message' => "Le mot de passe n'est pas indentique",
                    'label' => 'Confirmer votre Mot de passe',
                    'required'=> true,
                    'first_options'=>['label' => 'Mot de passe','attr'=> ['placeholder'=>"Entrez votre mot de passe"]],
                    'second_options'=> ['label'=>'Confirmez votre mot de passe','attr'=> ['placeholder'=>"Entrez à nouveau votre mot de passe"]]
                ])
            ->add('submit', SubmitType::class, ['label' =>'Mettre à jour']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
