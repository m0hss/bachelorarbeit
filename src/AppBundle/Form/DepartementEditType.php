<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class DepartementEditType extends AbstractType
{
    protected $chef;

    public function __construct($chef)
    {
        $this->chef = $chef;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $chef = $this->chef;

        $builder
            ->add(
                'nom',
                'text',
                array(
                    'required' => true,
                    'label' => "Nom departement",
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'chef',
                'entity',
                array(
                    'required' => true,
                    'class' => 'UserBundle:User',
                    'property' => 'uniqueNom',
                    'multiple' => false,
                    'expanded' => false,
                    'empty_value' => 'Chef département',
                    'attr' => array('class' => 'form-control'),
                    'query_builder' => function (\UserBundle\Entity\UserRepository $er) use($chef){
                        $role = 'ROLE_CHEF_DEPARTEMENT';
                        return $er->createQueryBuilder('u')
                            ->Where('u.id = :id')
                            ->setParameter('id', $chef)
                            ->orWhere('u.roles NOT LIKE :roles')
                            ->setParameter('roles', '%' . $role . '%')
                            ;
                    }
                )
            );

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Departement'
            )
        );
    }

    public function getName()
    {
        return null;
    }
}
 