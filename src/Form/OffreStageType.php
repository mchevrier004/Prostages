<?php

namespace App\Form;

use App\Entity\OffreStage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Formation;
use App\Entity\Entreprise;

class OffreStageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entreprise', EntityType::class, [
                'class' => Entreprise::class,
                'choice_label' => 'nom',
                'label' => 'Nom de l\'entreprise'
            ])
            ->add('Description', TextType::class, ['label' => 'Description du stage'])
            ->add('Nom', TextType::class, ['label' => 'Nom du stage'])
            ->add('Mail', EmailType::class, ['label' => 'E-mail de contact'])
            ->add('Tel', TelType::class, ['label' => 'Numéro de téléphone'])
            ->add('formations', EntityType::class, [
                'class' => Formation::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Formations concernées'
            ])
            ->add('save',SubmitType::class, ['label' => 'Créer un stage'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OffreStage::class,
        ]);
    }
}
