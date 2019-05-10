<?php

namespace App\Repository;

use App\Entity\FormTest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FormTest|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormTest|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormTest[]    findAll()
 * @method FormTest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormTestRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FormTest::class);
    }

    // /**
    //  * @return FormTest[] Returns an array of FormTest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FormTest
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
