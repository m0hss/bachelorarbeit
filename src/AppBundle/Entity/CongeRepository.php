<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * CongeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CongeRepository extends EntityRepository
{


    public function listeDemandesConge($departement)
    {
        $qb = $this->createQueryBuilder('c')
            ->leftJoin('c.demandeur', 'd')->addSelect('d')
            ->Where('c.etat = 3 OR c.etat = 4 OR c.etat = 5')
            // etat 3 ca veut dire accepter par le remplaceur et le responsable recoit seulement
            //les conges accepté par le remplaceur
            ->andWhere('d.departement = :departement')
            ->setParameter('departement', $departement)
            ->orderBy('c.id', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function listeEmployesEnConge($departement)
    {

        $qb = $this->createQueryBuilder('c')
            ->leftJoin('c.demandeur', 'd')->addSelect('d')
            ->Where('c.etat = 5')
            // etat 5 ca veut dire validé
            ->andWhere('d.departement = :departement')
            ->setParameter('departement', $departement)
            ->andWhere(':now BETWEEN c.dateDebut AND c.dateFin')
            ->setParameter('now', new \Datetime())
            ->orderBy('c.id', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function verifier(
        $user = null,
        $typeConge = null
    ) {
        $year = Date('Y');

        $qb = $this->createQueryBuilder('c')
            ->select('sum(c.nbJours)')
            ->Where('c.demandeur = :demandeur')
            ->setParameter('demandeur', $user)
            ->andWhere('c.typeConge = :typeConge')
            ->setParameter('typeConge', $typeConge)
            ->andwhere('c.dateDebut like :year')
            ->setParameter('year',  '%'.$year.'%')
            ->andWhere('c.etat = 5');

        return $qb->getQuery()->getSingleScalarResult();
    }


    public function mesConge($demandeur)
    {
        $qb = $this->createQueryBuilder('c')

            ->Where('c.demandeur = :demandeur')
            ->setParameter('demandeur', $demandeur)
            ->orderBy('c.dateDemande', 'DESC');

        return $qb->getQuery()->getResult();
    }


}