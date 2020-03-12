<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder

            ->add(
                'username',
                null,
                array(
                    'label' => 'form.username',
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array('class' => 'form-control', 'placeholder' => "Nom d'utilisateur")
                )
            )
            ->add(
                'plainPassword',
                'repeated',
                array(
                    'type' => 'password',
                    'options' => array('translation_domain' => 'FOSUserBundle'),
                    'first_options' => array(
                        'label' => 'form.password',
                        'attr' => array('class' => 'form-control', 'placeholder' => "Mot de passe")
                    ),
                    'second_options' => array(
                        'label' => 'form.password_confirmation',
                        'attr' => array('class' => 'form-control', 'placeholder' => "Confirmation")
                    ),
                    'invalid_message' => 'fos_user.password.mismatch',
                )
            )
            ->add(
                'nom',
                'text',
                array(
                    'required' => true,
                    'label' => 'Nom',
                    'attr' => array('class' => 'form-control', 'placeholder' => "Nom")
                )
            )
            ->add(
                'prenom',
                'text',
                array(
                    'required' => true,
                    'label' => 'Prénom',
                    'attr' => array('class' => 'form-control', 'placeholder' => "Prenom")
                )
            )
            ->add(
                'sexe',
                'choice',
                array(
                    'required' => true,
                    'label' => 'Sexe',
                    'choices' => array('Homme' => 'Homme', 'Femme' => 'Femme'),
                    'empty_value' => 'Sexe',
                    'attr' => array('class' => 'form-control'),
                    'multiple' => false,
                    'expanded' => false,
                )
            )
            ->add(
                'dateNaissance',
                'date',
                array(
                    'required' => true,
                    'label' => 'Date naissance',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'form-control date-picker', 'id' => 'id-date-picker-1'),
                )
            )
            ->add(
                'tel',
                'text',
                array(
                    'required' => true,
                    'label' => 'Téléphone domicile',
                    'attr' => array('class' => 'form-control', 'placeholder' => "Telephone"),
                )
            )
            ->add(
                'adresse',
                'text',
                array(
                    'required' => true,
                    'label' => 'Adresse',
                    'attr' => array('class' => 'form-control', 'placeholder' => "Adresse"),
                )
            )
            ->add(
                'ville',
                'entity',
                array(
                    'required' => false,
                    'class' => 'AppBundle:Ville',
                    'property' => 'nom',
                    'multiple' => false,
                    'expanded' => false,
                    'empty_value' => 'Ville',
                    'attr' => array('class' => 'form-control', 'placeholder' => "Ville"),
                )
            )
            ->add(
                'codePostal',
                'integer',
                array(
                    'required' => true,
                    'label' => 'Code Postal',
                    'attr' => array('class' => 'form-control', 'placeholder' => "Code Postal"),
                )
            );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'UserBundle\Entity\User'
            )
        );
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'user_registration';
    }
}
