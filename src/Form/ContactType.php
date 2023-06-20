<?php

namespace App\Form;

use App\Entity\Contact;
use PharIo\Manifest\Email;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name',TextType::class,[

                    'attr' => [
                        'class' => 'form-control',
                        'minlenght' => '2',
                        'maxlenght' => '100',
                    ],
                    'label' => 'Nom/Prénom',
                    'label_attr' => [
                        'class' => 'form-label  mt-4'
                    ],
                    'constraints' => [
                        new Length(['min' => 2, 'max' => 100])
                    ]


            ])

            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '180',
                ],


                'label' => 'Adresse email',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
                'constraints' => [
                    new NotBlank(),

                    new Length(['min' => 2, 'max' => 180])
                ]
            ])

            ->add('sujet',TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'minlenght' => '2',
                        'maxlenght' => '100',
                    ],
                    'label' => 'Sujet',
                    'label_attr' => [
                        'class' => 'form-label  mt-4'
                    ],
                    'constraints' => [
                        new Length(['min' => 2, 'max' => 100])
                    ]
                ]

            )
            ->add('message',TextareaType::class, [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'label' => 'Description',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ],
                    'constraints' => [
                        new NotBlank()
                    ]
                ]

            )
            ->add('submit',SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-primary mt-4'
                    ],
                'label'=>"Soumettre ma demande"
                ]);

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
