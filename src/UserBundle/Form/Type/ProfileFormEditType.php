<?php
namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormEditType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //parent::buildForm($builder, $options);
        $builder
            ->add(
                'username',
                'text',
                array(
                    'required' => false,
                    'label' => 'Login',
                    'attr' => array('class' => 'input-large')
                )
            )
            ->add(
                'email',
                'email',
                array(
                    'required' => true,
                    'label' => 'E-mail',
                    'attr' => array('class' => 'input-large')
                )
            )
            ->add(
                'nom',
                'text',
                array(
                    'required' => false,
                    'label' => 'Nom',
                    'attr' => array('class' => 'input-large')
                )
            )
            ->add(
                'prenom',
                'text',
                array(
                    'required' => false,
                    'label' => 'Prénom',
                    'attr' => array('class' => 'input-large')
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
                    'attr' => array('class' => 'form-control input-medium'),
                    'multiple' => false,
                    'expanded' => false,
                )
            )
            ->add(
                'dateNaissance',
                'datetime',
                array(
                    'required' => true,
                    'label' => 'Date naissance',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'input-large date-picker', 'id' => 'id-date-picker-1'),
                )
            )
            ->add(
                'tel',
                'text',
                array(
                    'required' => false,
                    'label' => 'Téléphone domicile',
                    'attr' => array('class' => 'input-large'),
                )
            )
            ->add(
                'ville',
                'entity',
                array(
                    'required' => true,
                    'class' => 'AppBundle:Ville',
                    'property' => 'nom',
                    'multiple' => false,
                    'expanded' => false,
                    'empty_value' => 'Ville',
                    'attr' => array('class' => 'input-large'),
                )
            )
            ->add(
                'adresse',
                'text',
                array(
                    'required' => false,
                    'label' => 'Adresse',
                    'attr' => array('class' => 'input-xlarge'),
                )
            )
            ->add(
                'codePostal',
                'integer',
                array(
                    'required' => false,
                    'label' => 'Code Postal',
                    'attr' => array('class' => 'input-large'),
                )
            )
            ->add('image', new ImageType(), array(
                'required' => false,
                'label' => false,
            ))
            ->remove('plainPassword');
    }

    public function getName()
    {
        return 'user_profile_edit';
    }
}
