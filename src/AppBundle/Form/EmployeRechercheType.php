<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class EmployeRechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add(
                'nom',
                'text',
                array(
                    'required' => false,
                    'label' => "Nom",
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'prenom',
                'text',
                array(
                    'required' => false,
                    'label' => "Prénom",
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'username',
                'text',
                array(
                    'required' => false,
                    'label' => "Matricule",
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'cin',
                'text',
                array(
                    'required' => false,
                    'label' => "Cin",
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'sexe',
                'choice',
                array(
                    'required' => false,
                    'label' => 'Sexe',
                    'choices' => array('Homme' => 'Homme', 'Femme' => 'Femme'),
                    'multiple' => false,
                    'expanded' => false,
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'fonction',
                'entity',
                array(

                    'class' => 'AppBundle:Fonction',
                    'property' => 'nom',
                    'multiple' => false,
                    'expanded' => false,
                    'empty_value' => 'fonction',
                    'attr' => array('class' => 'form-control'),
                    'label'=>'Fonctioin',
                    'required'=> false
                )
            )
            ->add(
                'departement',
                'entity',
                array(

                    'class' => 'AppBundle:Departement',
                    'property' => 'nom',
                    'multiple' => false,
                    'expanded' => false,
                    'empty_value' => 'departement',
                    'attr' => array('class' => 'form-control'),
                    'label'=> 'Département',
                    'required'=> false
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
 