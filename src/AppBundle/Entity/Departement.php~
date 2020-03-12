<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Departement
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Departement
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
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $chef;


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
     * @return Departement
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
     * @return Departement
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
     * Set chef
     *
     * @param \UserBundle\Entity\User $chef
     * @return Departement
     */
    public function setChef(\UserBundle\Entity\User $chef = null)
    {
        $this->chef = $chef;

        return $this;
    }

    /**
     * Get chef
     *
     * @return \UserBundle\Entity\User 
     */
    public function getChef()
    {
        return $this->chef;
    }
}
