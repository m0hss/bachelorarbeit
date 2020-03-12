<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Conge
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CongeRepository")
 */
class Conge
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date")
     */
    private $dateDebut;

    /**
     *
     * @ORM\Column(name="dateFin", type="string", length=11)
     */
    private $dateFin;

    /**
     * @var integer
     * @ORM\Column(name="nbJours", type="integer")
     */
    private $nbJours;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_demande", type="datetime")
     */
    private $dateDemande;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypeConge")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeConge;


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $demandeur;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $remplaceur;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EtatConge")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etat;


    /**
     * Construct
     */
    public function __construct()
    {
        $this->dateDemande           = new \Datetime();
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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Conge
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }



    /**
     * Set dateDemande
     *
     * @param \DateTime $dateDemande
     * @return Conge
     */
    public function setDateDemande($dateDemande)
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    /**
     * Get dateDemande
     *
     * @return \DateTime 
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }


    /**
     * Set demandeur
     *
     * @param \UserBundle\Entity\User $demandeur
     * @return Conge
     */
    public function setDemandeur(\UserBundle\Entity\User $demandeur)
    {
        $this->demandeur = $demandeur;

        return $this;
    }

    /**
     * Get demandeur
     *
     * @return \UserBundle\Entity\User 
     */
    public function getDemandeur()
    {
        return $this->demandeur;
    }

    /**
     * Set remplaceur
     *
     * @param \UserBundle\Entity\User $remplaceur
     * @return Conge
     */
    public function setRemplaceur(\UserBundle\Entity\User $remplaceur)
    {
        $this->remplaceur = $remplaceur;

        return $this;
    }

    /**
     * Get remplaceur
     *
     * @return \UserBundle\Entity\User 
     */
    public function getRemplaceur()
    {
        return $this->remplaceur;
    }



    /**
     * Set etat
     *
     * @param \AppBundle\Entity\EtatConge $etat
     * @return Conge
     */
    public function setEtat(\AppBundle\Entity\EtatConge $etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return \AppBundle\Entity\EtatConge 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set typeConge
     *
     * @param \AppBundle\Entity\TypeConge $typeConge
     * @return Conge
     */
    public function setTypeConge(\AppBundle\Entity\TypeConge $typeConge)
    {
        $this->typeConge = $typeConge;

        return $this;
    }

    /**
     * Get typeConge
     *
     * @return \AppBundle\Entity\TypeConge 
     */
    public function getTypeConge()
    {
        return $this->typeConge;
    }

    /**
     * Set nbJours
     *
     * @param integer $nbJours
     * @return Conge
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

    /**
     * Set dateFin
     *
     * @param string $dateFin
     * @return Conge
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return string
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }
}
