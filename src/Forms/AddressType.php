<?php

namespace App\Forms;

use App\Entity\Address;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        $formBuilder
            ->add('location', LocationType::class, [
                'mapped' => false,
            ])
            ->add('addressStreet')
            ->add('addressNumber')
            ->add('zipCode');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Address::class]);
    }
}