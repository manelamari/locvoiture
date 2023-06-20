<?php

namespace App\Form;

use App\Entity\User;
use phpDocumentor\Reflection\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '100',
            ],
                    'label'=>false,
                    'label_attr'=>[
                        'class'=>'form-label  mb-4'
                    ],
                    'constraints'=>[
                        new Length(['min' => 2, 'max' => 100])

                    ]
           ] )
            ->add('prenom',TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '100',
                ],
                'label'=>false,
                'label_attr'=>[
                    'class'=>'form-label  mt-4'
                ],
                'constraints'=>[
                    new Length(['min' => 2, 'max' => 100])

                ]
            ] )
            ->add('email',EmailType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'label'=>false,
                'label_attr'=>[
                    'class'=>'form-label  mt-4'
                ],

    ])
            ->add('telephone',TextType::class,[
                'attr' => [
        'class' => 'form-control',
    ],
                    'label'=>false,
                    'label_attr'=>[
                        'class'=>'form-label  mt-4'
                    ],
           ] )
            ->add('rue',TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'label'=>false,
                'label_attr'=>[
                    'class'=>'form-label  mt-4'
                ],
            ])
            ->add('codePastale',TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                ],
                'label'=>false,
                'label_attr'=>[
                    'class'=>'form-label  mt-4'
                ],
            ])
           -> add('ville',TextType::class,[
               'attr' => [
                   'class' => 'form-control',
               ],
               'label'=>false,
               'label_attr'=>[
                   'class'=>'form-label  mt-4'
               ],
           ])



             ->add('plainPassword', PasswordType::class, [
              'attr' => [
                  'class'=>'from-control',
                  'autocomplete' => 'new-password',

              ],


                 'label'=>false,
                 'label_attr'=>[
                     'class'=>'form-label  mt-4'
                 ],
                 'mapped' => false,
                  'constraints' => [
                      new NotBlank([
                          'message' => 'Saisir votre mot de passe',
                      ]),
                      new Length([
                          'min' => 4,
                          'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} characters',
                          // max length allowed by Symfony for security reasons
                          'max' => 4096,
                      ]),
                  ],
              ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
