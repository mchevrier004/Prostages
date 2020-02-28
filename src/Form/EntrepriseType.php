<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            -> add('nom', TextType::class, ['label' => 'Nom de l\'entreprise : '])
            -> add('type', TextType::class, ['label' => 'Activité : '])
            -> add('site',UrlType::class, ['label' => 'Site web : '])
            -> add('adresse', TextType::class, ['label' => 'Adresse : '])
            -> add('tel',TelType::class, ['label' => 'Numéro de téléphone : '])
            -> add('save',SubmitType::class, ['label' => 'Créer une entreprise'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
