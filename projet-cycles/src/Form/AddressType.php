<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label'=>"Nom de l'adresse"
            ])
            ->add('firstName', TextType::class,[
                'label'=>'Prénom'
            ])
            ->add('lastName', TextType::class,[
                'label'=>'Nom'
            ])
            ->add('company', TextType::class,[
                'label'=>'Société',
                'required'=>false
            ])
            ->add('address', TextType::class,[
                'label'=>'Adresse'
            ])
            ->add('postal', TextType::class,[
                'label'=>'code postal'
            ])
            ->add('city', TextType::class,[
                'label'=>'Ville'
            ])
            ->add('country', CountryType::class,[
                'label'=>'Pays'
            ])
            ->add('phone', TelType::class,[
                'label'=>'Télephone'
            ])
            ->add('submit',SubmitType::class,[
                'label'=> 'Valider',
                'attr'=>[
                    'class' =>'btn btn-success btn-block'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
