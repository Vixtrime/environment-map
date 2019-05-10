<?php

namespace App\Repository;

use App\Entity\SessionOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SessionOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method SessionOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method SessionOrder[]    findAll()
 * @method SessionOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionOrderRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SessionOrder::class);
    }

    // /**
    //  * @return SessionOrder[] Returns an array of SessionOrder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SessionOrder
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
