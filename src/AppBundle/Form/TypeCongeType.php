<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class TypeCongeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add(
                'nom',
                'text',
                array(
                    'required' => true,
                    'label' => "Nom type conge",
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'sexe',
                'choice',
                array(
                    'label' => "Sexe",
                    'attr' => array('class' => 'form-control'),
                    'expanded'=> false,
                    'required'=> true,
                    'choices' => array('Homme-Femme' => 'Homme-Femme', 'Homme' => 'Homme', 'Femme'=>'Femme')
                )
            )
            ->add(
                'nbJours',
                'integer',
                array(
                    'required' => false,
                    'label' => 'Nb jours',
                    'attr' => array('class' => 'form-control'),
                )
            )

        ;

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\TypeConge'
            )
        );
    }

    public function getName()
    {
        return null;
    }
}
 