<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('nom',TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                                             ],
                'label'=>'Nom',
                'label_attr'=>[
                    'class'=>'form-label  mb-2']
            ])

            ->add('prenom',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                    ],
                'label'=>'Prénom',
                'label_attr'=>[
                    'class'=>'form-label  mb-2']

            ])
            ->add('email',EmailType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Email',
                'label_attr'=>[
                    'class'=>'form-label  mb-2']
            ])
           // ->add('roles')
           ->add('telephone',TextType::class,[
               'attr'=>[
                   'class'=>'form-control'
               ],
               'label'=>'téléphone',
               'label_attr'=>[
                   'class'=>'form-label  mb-2']

           ])
            ->add('rue',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Rue',
                'label_attr'=>[
                    'class'=>'form-label  mb-2']

            ])
            ->add('codePastale',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Code Postale',
                'label_attr'=>[
                    'class'=>'form-label  mb-2']

            ])

            ->add('ville',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Ville',
                'label_attr'=>[
                    'class'=>'form-label  mb-2']

            ])


           // ->add('password',TextType::class)
            //->add('slug')







        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
