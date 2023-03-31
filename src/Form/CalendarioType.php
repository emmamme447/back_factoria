<?php

namespace App\Form;

use App\Entity\Calendario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo')
            ->add('asunto')
            ->add('nombre_destinatario')
            ->add('correo_destinatario')
            ->add('fecha')
            ->add('estado')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calendario::class,
        ]);
    }
}
