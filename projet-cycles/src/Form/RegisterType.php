<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class,
                ['label' => 'Prénom',
                    'attr' => ['placeholder' => 'Linus'],
                    'constraints'=> new Length(['min'=>2,'max'=>30])
                ])
            ->add('lastName', TextType::class,
                ['label' => 'Nom',
                    'attr' => ['placeholder' => 'Torvalds'],
                    'constraints'=> new Length(['min'=>2,'max'=>30])
                ])
            ->add('email', EmailType::class,
                ['label' => 'Mail',
                    'attr' => ['placeholder' => 'Exemple@mail.fr'],
                    'constraints'=> new Length(['min'=>2,'max'=>30])

                ])
            ->add('password', RepeatedType::class,
                ['type' => PasswordType::class,
                    'invalid_message' => "Le mot de passe n'est pas indentique",
                    'label' => 'Confirmer votre Mot de passe',
                    'required'=> true,
                    'first_options'=>['label' => 'Mot de passe','attr'=> ['placeholder'=>"Entrez votre mot de passe"]],
                    'second_options'=> ['label'=>'Confirmez votre mot de passe','attr'=> ['placeholder'=>"Entrez à nouveau votre mot de passe"]]
                ])
            ->add('submit', SubmitType::class, ['label' => "S'inscrire"]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
