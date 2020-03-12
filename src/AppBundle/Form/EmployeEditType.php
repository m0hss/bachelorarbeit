<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class EmployeEditType extends EmployeType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

            ->add(
                'nom',
                'text',
                array(
                    'required' => true,
                    'label' => "Nom",
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'prenom',
                'text',
                array(
                    'required' => true,
                    'label' => "Prénom",
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'username',
                'text',
                array(
                    'required' => true,
                    'label' => "Imatricule",
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'cin',
                'text',
                array(
                    'required' => true,
                    'label' => "Cin",
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'sexe',
                'choice',
                array(
                    'required' => true,
                    'label' => 'Sexe',
                    'choices' => array('Homme' => 'Homme', 'Femme' => 'Femme'),
                    'attr' => array('class' => ''),
                    'multiple' => false,
                    'expanded' => true,
                )
            )
            ->add(
                'dateNaissance',
                'date',
                array(
                    'required' => true,
                    'label' => 'Date naissance',
                    'widget' => 'single_text',
                    'attr' => array('class' => 'form-control', 'id' => ''),
                )
            )
            ->add(
                'tel',
                'integer',
                array(
                    'required' => false,
                    'label' => 'Téléphone',
                    'attr' => array('class' => 'form-control'),
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
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'adresse',
                'text',
                array(
                    'required' => false,
                    'label' => 'Adresse',
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'codePostal',
                'integer',
                array(
                    'required' => false,
                    'label' => 'Code Postal',
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'fonction',
                'entity',
                array(
                    'required' => false,
                    'class' => 'AppBundle:Fonction',
                    'property' => 'nom',
                    'multiple' => false,
                    'expanded' => false,
                    'empty_value' => 'fonction',
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'departement',
                'entity',
                array(
                    'required' => false,
                    'class' => 'AppBundle:Departement',
                    'property' => 'nom',
                    'multiple' => false,
                    'expanded' => false,
                    'empty_value' => 'departement',
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'image',
                new ImageType(),
                array(
                    'required' => false,
                    'label' => false,
                )
            )
           ;

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'UserBundle\Entity\User'
            )
        );
    }

    public function getName()
    {
        return null;
    }
}
 