<?php

namespace App\Forms;

use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        $formBuilder
            ->add('firstName')
            ->add('lastName')
            ->add('birthday', DateType::class, [
                'widget' => 'choice',
                'years'  => range(date('Y') - 100, date('Y')),
            ]
            )
            ->add('contacts', CollectionType::class,
                  [
                      'entry_type'    => ContactType::class,
                      'entry_options' => ['label' => false],
                      'allow_add'     => true,
                      'by_reference'  => false,
                  ]
            )
            ->add('addresses', CollectionType::class,
                  [
                      'entry_type'    => AddressType::class,
                      'entry_options' => ['label' => false],
                      'allow_add'     => true,
                      'by_reference'  => false,
                  ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Person::class]);
    }
}