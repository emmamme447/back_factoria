<?php

namespace App\Repository;

use App\Entity\PeriodoPrueba;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PeriodoPrueba>
 *
 * @method PeriodoPrueba|null find($id, $lockMode = null, $lockVersion = null)
 * @method PeriodoPrueba|null findOneBy(array $criteria, array $orderBy = null)
 * @method PeriodoPrueba[]    findAll()
 * @method PeriodoPrueba[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeriodoPruebaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PeriodoPrueba::class);
    }

    public function save(PeriodoPrueba $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PeriodoPrueba $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PeriodoPrueba[] Returns an array of PeriodoPrueba objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PeriodoPrueba
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
