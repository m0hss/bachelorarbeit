<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TypeConge
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TypeCongeRepository")
 */
class TypeConge
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="text")
     * @Assert\NotBlank(message="Nom est vide.")
     */
    private $nom;

    /**
     * @Gedmo\slug(fields={"nom"})
     * @ORM\Column(name="slug",length=255, unique=true, nullable=false)
     */
    private $slug ;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="text")
     * @Assert\NotBlank(message="Sexe est vide.")
     */
    private $sexe;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     */
    protected $nbJours;

    public function __construct()
    {

    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set nom
     *
     * @param string $nom
     * @return TypeConge
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return TypeConge
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return TypeConge
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set nbJours
     *
     * @param integer $nbJours
     * @return TypeConge
     */
    public function setNbJours($nbJours)
    {
        $this->nbJours = $nbJours;

        return $this;
    }

    /**
     * Get nbJours
     *
     * @return integer 
     */
    public function getNbJours()
    {
        return $this->nbJours;
    }
}
