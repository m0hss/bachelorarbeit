<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class EmployeEditMdpType extends EmployeType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

            ->add(
                'plainPassword',
                'password',
                array(
                    'required' => true,
                    'label' => 'Nouveau mot de passe',
                    'attr' => array('class' => 'form-control'),
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
 