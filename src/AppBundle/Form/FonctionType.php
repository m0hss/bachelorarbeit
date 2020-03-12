<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class FonctionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add(
                'nom',
                'text',
                array(
                    'required' => true,
                    'label' => "Nom fonction",
                    'attr' => array('class' => 'form-control'),
                )
            );

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Fonction'
            )
        );
    }

    public function getName()
    {
        return null;
    }
}
 