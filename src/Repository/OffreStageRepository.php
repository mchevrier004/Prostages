<?php

namespace App\Repository;

use App\Entity\OffreStage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method OffreStage|null find($id, $lockMode = null, $lockVersion = null)
 * @method OffreStage|null findOneBy(array $criteria, array $orderBy = null)
 * @method OffreStage[]    findAll()
 * @method OffreStage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreStageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OffreStage::class);
    }


    /**
     * @return OffreStage[] Returns an array of OffreStage objects
     */
    
    public function findByNomEntreprise($nomEnt)
    {

        return $this->createQueryBuilder('o')
            ->join('o','e.stages')
            ->andWhere('e.nom = :nomEnt')
            ->setParameter('nomEnt', $nomEnt)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return OffreStage[] Returns an array of OffreStage objects
     */
    
    public function findByFormation($formation)
    {
        //Récupération du gestionnaire d'entité
        $gestionnaireEntite = $this->getEntityManager();

        //Construction de la requête
        $requete = $gestionnaireEntite->createQuery(
            'SELECT o
             FROM App\Entity\OffreStage o
             WHERE o.formation = :nomF');
        
        //Définition de la valeur du paramètre nomF
        $requete->setParameter('nomF', $formation);

        //Retourner les résultats
        return $requete->execute();
    }
    
    // /**
    //  * @return OffreStage[] Returns an array of OffreStage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OffreStage
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
