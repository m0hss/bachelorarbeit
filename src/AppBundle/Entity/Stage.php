<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Stage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\StageRepository")
 */
class Stage
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
     * @ORM\Column(name="nom", type="string", length=100)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     */
    protected $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     */
    private $email;


    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=10)
     */
    private $sexe;

    /**
     * @var \DateTime $dateNaissance
     *
     * @ORM\Column(name="datenaissance", type="date", nullable=true)
     *
     */
    protected $dateNaissance;

    /**
     * @var integer
     *
     * @ORM\Column(name="tel", type="integer")
     * @Assert\Length(
     *     min=8,
     *     max="8",
     *     minMessage="Téléphone  est court.",
     *     maxMessage="Téléphone est long."
     * )
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text")
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ville")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $ville;

    /**
     * @var integer
     *
     * @ORM\Column(name="code_postal", type="integer")
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="etablissement", type="string", length=100)
     */
    private $etablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_etablissement", type="text")
     */
    private $adresseEtablissement;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ville")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $villeEtablissement;

    /**
     * @var integer
     *
     * @ORM\Column(name="ccode_postal_etablissement", type="integer")
     */
    private $codePostalEtablissement;

    /**
     * @var integer
     *
     * @ORM\Column(name="tel_etablissement", type="integer")
     * @Assert\Length(
     *     min=8,
     *     max="8",
     *     minMessage="Téléphone  est court.",
     *     maxMessage="Téléphone est long."
     * )
     */
    private $telEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau_etude", type="string", length=100)
     */
    private $niveauEtude;

    /**
     * @var string
     *
     * @ORM\Column(name="diplome_prepare", type="string", length=100)
     */
    private $diplomePrepare;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_diplome", type="string", length=100)
     */
    private $titreDiplome;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date")
     *
     */
    protected $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     *
     */
    protected $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="lettre_motivation", type="text")
     */
    private $lettreMotivation;

    /**
     * @var string
     *
     * @ORM\Column(name="cv", type="text")
     */
    private $cv;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_demande", type="datetime")
     */
    private $dateDemande;

    /**
     * @var boolean
     *
     * @ORM\Column(name="valider", type="boolean")
     */
    private $valider;

    /**
     * @var boolean
     *
     * @ORM\Column(name="traiter", type="boolean")
     */
    private $traiter;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Departement")
     * @ORM\JoinColumn(nullable=true)
     */
    private $departement;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->dateDemande    = new \Datetime();
        $this->valider        = false;
        $this->traiter        = false;

    }

    protected $uniqueNom;

    public function getUniqueNom()
    {
        return sprintf('%s  %s', $this->nom, $this->prenom);
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
     * @return Stage
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
     * Set prenom
     *
     * @param string $prenom
     * @return Stage
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set tel
     *
     * @param integer $tel
     * @return Stage
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return integer 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Stage
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return Stage
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Stage
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
     * Set dateDemande
     *
     * @param \DateTime $dateDemande
     * @return Stage
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
     * Set valider
     *
     * @param boolean $valider
     * @return Stage
     */
    public function setValider($valider)
    {
        $this->valider = $valider;

        return $this;
    }

    /**
     * Get valider
     *
     * @return boolean 
     */
    public function getValider()
    {
        return $this->valider;
    }

    /**
     * Set traiter
     *
     * @param boolean $traiter
     * @return Conge
     */
    public function setTraiter($traiter)
    {
        $this->traiter = $traiter;

        return $this;
    }

    /**
     * Get traiter
     *
     * @return boolean
     */
    public function getTraiter()
    {
        return $this->traiter;
    }

    /**
     * Set departement
     *
     * @param \AppBundle\Entity\Departement $departement
     * @return Stage
     */
    public function setDepartement(\AppBundle\Entity\Departement $departement = null)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return \AppBundle\Entity\Departement 
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set cin
     *
     * @param integer $cin
     * @return Stage
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return integer 
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return Stage
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     * @return Stage
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return integer 
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set etablissement
     *
     * @param string $etablissement
     * @return Stage
     */
    public function setEtablissement($etablissement)
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * Get etablissement
     *
     * @return string 
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }

    /**
     * Set adresseEtablissement
     *
     * @param string $adresseEtablissement
     * @return Stage
     */
    public function setAdresseEtablissement($adresseEtablissement)
    {
        $this->adresseEtablissement = $adresseEtablissement;

        return $this;
    }

    /**
     * Get adresseEtablissement
     *
     * @return string 
     */
    public function getAdresseEtablissement()
    {
        return $this->adresseEtablissement;
    }

    /**
     * Set codePostalEtablissement
     *
     * @param integer $codePostalEtablissement
     * @return Stage
     */
    public function setCodePostalEtablissement($codePostalEtablissement)
    {
        $this->codePostalEtablissement = $codePostalEtablissement;

        return $this;
    }

    /**
     * Get codePostalEtablissement
     *
     * @return integer 
     */
    public function getCodePostalEtablissement()
    {
        return $this->codePostalEtablissement;
    }

    /**
     * Set telEtablissement
     *
     * @param integer $telEtablissement
     * @return Stage
     */
    public function setTelEtablissement($telEtablissement)
    {
        $this->telEtablissement = $telEtablissement;

        return $this;
    }

    /**
     * Get telEtablissement
     *
     * @return integer 
     */
    public function getTelEtablissement()
    {
        return $this->telEtablissement;
    }

    /**
     * Set niveauEtude
     *
     * @param string $niveauEtude
     * @return Stage
     */
    public function setNiveauEtude($niveauEtude)
    {
        $this->niveauEtude = $niveauEtude;

        return $this;
    }

    /**
     * Get niveauEtude
     *
     * @return string 
     */
    public function getNiveauEtude()
    {
        return $this->niveauEtude;
    }

    /**
     * Set diplomePrepare
     *
     * @param string $diplomePrepare
     * @return Stage
     */
    public function setDiplomePrepare($diplomePrepare)
    {
        $this->diplomePrepare = $diplomePrepare;

        return $this;
    }

    /**
     * Get diplomePrepare
     *
     * @return string 
     */
    public function getDiplomePrepare()
    {
        return $this->diplomePrepare;
    }

    /**
     * Set titreDiplome
     *
     * @param string $titreDiplome
     * @return Stage
     */
    public function setTitreDiplome($titreDiplome)
    {
        $this->titreDiplome = $titreDiplome;

        return $this;
    }

    /**
     * Get titreDiplome
     *
     * @return string 
     */
    public function getTitreDiplome()
    {
        return $this->titreDiplome;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Stage
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
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Stage
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set lettreMotivation
     *
     * @param string $lettreMotivation
     * @return Stage
     */
    public function setLettreMotivation($lettreMotivation)
    {
        $this->lettreMotivation = $lettreMotivation;

        return $this;
    }

    /**
     * Get lettreMotivation
     *
     * @return string 
     */
    public function getLettreMotivation()
    {
        return $this->lettreMotivation;
    }

    /**
     * Set cv
     *
     * @param string $cv
     * @return Stage
     */
    public function setCv($cv)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return string 
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set ville
     *
     * @param \AppBundle\Entity\Ville $ville
     * @return Stage
     */
    public function setVille(\AppBundle\Entity\Ville $ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return \AppBundle\Entity\Ville 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set villeEtablissement
     *
     * @param \AppBundle\Entity\Ville $villeEtablissement
     * @return Stage
     */
    public function setVilleEtablissement(\AppBundle\Entity\Ville $villeEtablissement = null)
    {
        $this->villeEtablissement = $villeEtablissement;

        return $this;
    }

    /**
     * Get villeEtablissement
     *
     * @return \AppBundle\Entity\Ville 
     */
    public function getVilleEtablissement()
    {
        return $this->villeEtablissement;
    }
}
