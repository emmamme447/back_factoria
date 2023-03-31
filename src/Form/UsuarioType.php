<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('apellido')
            ->add('email')
            ->add('roles')
            ->add('identificador')
            ->add('cargo')
            ->add('escuela')
            ->add('area')
            ->add('fecha_de_inicio')
            ->add('fecha_de_finalizacion')
            ->add('responsable')
            ->add('foto', FileType::class, [
                    'label' => 'Seleccione una imagen',
    
                    // unmapped means that this field is not associated to any entity property
                    'mapped' => false,
    
                    // make it optional so you don't have to re-upload the PDF file
                    // every time you edit the Product details
                    'required' => false,
    
                    // unmapped fields can't define their validation using annotations
                    // in the associated entity, so you can use the PHP constraint classes
                    // 'constraints' => [
                    //     new File([
                    //         'maxSize' => '1024k',
                    //         'mimeTypes' => [
                    //             'application/pdf',
                    //             'application/x-pdf',
                    //         ],
                    //         'mimeTypesMessage' => 'Please upload a valid PDF document',
                    //     ])
                    // ],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
