<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('debut',DateType::class,[

                'widget'=>'single_text',
                'input'=>'datetime',
                'label'=>'Début de location',
                'label_attr'=>[
                    'class'=>'form-label  mt-4'],
                'attr' => [
                    'class' => 'form-control',]





            ])
            ->add('fin',DateType::class,[

                'widget'=>'single_text',
                //'html5'=>false,
                'input'=>'datetime',
                'label'=>'Fin de location',
                'label_attr'=>[
                    'class'=>'form-label  mt-4'
                ],
                // 'constraints'=>
                //    new greaterThan([
                //       'propertyPath' => 'parent.all[debut].data',
                //       'message' => 'il faut que la date fin soit supperieure de ladatr debut ....',])
                //'input_format'=>'dd-MM-yyyy',
                'attr' => [
                    'class' => 'form-control',]
            ])
            ->add('categorie',EntityType::class,[
                'class'=>Category::class,
                'attr' => [
                    'class' => 'form-control'
                ],

                'label'=> 'Categorie',

                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
                'required'=> false,

            ])
            ->add('min', NumberType::class, [
                'label' => 'Prix Min',
                'label_attr'=>[
                    'class'=>'from-label mt-4'
                ],
                'required' => false,

                'attr' => [
                    'class' => 'form-control'
                ],


            ])
            ->add('max', NumberType::class, [
                'label' =>'Prix Max',
                'label_attr'=>[
                    'class' => 'form-label  mt-4'
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false,
            ])
            ->add('rechercher',SubmitType::class,[
            'attr'=>[
        'class'=>'btn btn-primary mt-4'
    ],
                'label'=>"Rechercher"
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>SearchData::class,
            'method'=>'GET',
            'csrf_protection'=>false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}