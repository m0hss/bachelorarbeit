<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class StageType extends AbstractType
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
                'sexe',
                'choice',
                array(
                    'required' => true,
                    'label' => 'Sexe',
                    'choices' => array('Homme' => 'Homme', 'Femme' => 'Femme'),
                    'multiple' => false,
                    'expanded' => true,
                    'data'=> 'Homme'
                )
            )
            ->add(
                'cin',
                'integer',
                array(
                    'required' => true,
                    'label' => "Cin",
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'tel',
                'integer',
                array(
                    'required' => true,
                    'label' => 'Téléphone',
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'email',
                'email',
                array(
                    'required' => true,
                    'label' => 'Email',
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'adresse',
                'text',
                array(
                    'required' => true,
                    'label' => 'Adresse',
                    'attr' => array('class' => 'form-control'),
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
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'codePostal',
                'integer',
                array(
                    'required' => true,
                    'label' => 'Code Postal',
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'departement',
                'entity',
                array(
                    'required' => true,
                    'class' => 'AppBundle:Departement',
                    'property' => 'nom',
                    'multiple' => false,
                    'expanded' => false,
                    'empty_value' => 'departement',
                    'attr' => array('class' => 'form-control'),
                    'label'=> 'Département'
                )
            )
            ->add(
                'niveauEtude',
                'text',
                array(
                    'required' => true,
                    'label' => 'Niveau étude',
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'diplomePrepare',
                'text',
                array(
                    'required' => true,
                    'label' => 'Diplome prépare',
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'titreDiplome',
                'text',
                array(
                    'required' => true,
                    'label' => 'Titre diplome',
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'dateDebut',
                'date',
                array(
                    'required' => true,
                    'label' => 'Date debut',
                    'widget' => 'single_text',
                    'attr' => array('class' => 'form-control', 'id' => ''),
                )
            )
            ->add(
                'dateFin',
                'date',
                array(
                    'required' => true,
                    'label' => 'Date fin',
                    'widget' => 'single_text',
                    'attr' => array('class' => 'form-control', 'id' => ''),
                )
            )
            ->add(
                'etablissement',
                'text',
                array(
                    'required' => true,
                    'label' => 'Nom Etablissement',
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'adresseEtablissement',
                'text',
                array(
                    'required' => true,
                    'label' => 'Adresse etablissement',
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'villeEtablissement',
                'entity',
                array(
                    'required' => true,
                    'class' => 'AppBundle:Ville',
                    'property' => 'nom',
                    'multiple' => false,
                    'expanded' => false,
                    'empty_value' => 'Ville etablissement',
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'codePostalEtablissement',
                'integer',
                array(
                    'required' => true,
                    'label' => 'Code postal etablissement',
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'telEtablissement',
                'integer',
                array(
                    'required' => true,
                    'label' => 'Télephone etablissement',
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add(
                'lettreMotivation',
                'textarea',
                array(
                    'required' => true,
                    'label' => 'Lettre de motivation',
                    'attr' => array('class' => 'form-control', 'rows'=>'6'),
                )
            )
            ->add(
                'cv',
                'textarea',
                array(
                    'required' => true,
                    'label' => 'Votre CV',
                    'attr' => array('class' => 'form-control', 'rows'=>'6'),
                )
            )
        ;

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Stage'
            )
        );
    }

    public function getName()
    {
        return null;
    }
}
 