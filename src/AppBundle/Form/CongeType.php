<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class CongeType extends AbstractType
{

    private $securityContext;


    public function __construct(SecurityContext $securityContext)
    {
        $this->securityContext = $securityContext;

    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $id = $this->securityContext->getToken()->getUser()->getId();
        $departement = $this->securityContext->getToken()->getUser()->getDepartement();
        $sexe = $this->securityContext->getToken()->getUser()->getSexe();

        $builder
            ->add(
                'nbJours',
                'integer',
                array(
                    'required' => true,
                    'label' => 'Nb jours',
                    'attr' => array('class' => 'col-xs-3', 'min'=>'1', 'max'=>''),
                )
            )
            ->add(
                'dateDebut',
                'date',
                array(
                    'required' => true,
                    'label' => 'Date Debut',
                    'widget' => 'single_text',
                    'attr' => array('class' => 'form-control dateDebut', 'id' => ''),
                )
            )
            ->add(
                'dateFin',
                'text',
                array(
                    'required' => true,
                    'label' => 'Date fin',
                    'attr' => array('class' => 'form-control'),
                    'read_only'=> true,
                )
            )

            ->add(
                'remplaceur',
                'entity',
                array(
                    'required' => true,
                    'class' => 'UserBundle:User',
                    'property' => 'uniqueNom',
                    'multiple' => false,
                    'expanded' => false,
                    'empty_value' => 'Remplacer par',
                    'attr' => array('class' => 'form-control'),
                    'query_builder' => function(\UserBundle\Entity\UserRepository $er ) use($id, $departement )  {
                        $role = 'ROLE_CHEF_DEPARTEMENT';
                        $role2 = 'ROLE_ADMIN';
                        return $er->createQueryBuilder('u')
                            ->where('u.id <> :id')
                            ->setParameter('id', $id)
                            ->andWhere('u.departement = :departement')
                            ->setParameter('departement', $departement)
                            ->andWhere('u.roles NOT LIKE :roles')
                            ->setParameter('roles', '%'.$role.'%')

                            ;
                    }
                )
            )
            ->add(
                'typeConge',
                'entity',
                array(
                    'required' => true,
                    'class' => 'AppBundle:TypeConge',
                    'property' => 'nom',
                    'multiple' => false,
                    'expanded' => false,
                    'empty_value' => 'Type de conge',
                    'attr' => array('class' => 'form-control'),
                    'query_builder' => function(\AppBundle\Entity\TypeCongeRepository $er ) use($sexe)  {
                        return $er->createQueryBuilder('t')
                            ->where('t.sexe = :sexe')
                            ->setParameter('sexe', $sexe)
                            ->orWhere('t.sexe like :sexes')
                            ->setParameter('sexes', '%Homme-Femme%')
                         ;
                    }
                )
            )

        ;

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Conge'
            )
        );
    }

    public function getName()
    {
        return null;
    }
}
 