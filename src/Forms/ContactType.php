<?php

namespace App\Forms;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        $formBuilder
            ->add('headline', TextType::class, [
                'required' => false,
                'attr'     => [
                    'placeholder' => 'Contact description'
                ]
            ]
            )
            ->add('phone', TextType::class, [
                'required' => false,
                'attr'     => [
                    'placeholder' => '+1 (234) 567-89-00'
                ]
            ]
            )
            ->add('email', EmailType::class, [
                'required' => false,
                'attr'     => [
                    'placeholder' => 'your@emal.com'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Contact::class]);
    }
}