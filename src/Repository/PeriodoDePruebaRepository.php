<?php

namespace App\Repository;

use App\Entity\PeriodoDePrueba;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PeriodoDePrueba>
 *
 * @method PeriodoDePrueba|null find($id, $lockMode = null, $lockVersion = null)
 * @method PeriodoDePrueba|null findOneBy(array $criteria, array $orderBy = null)
 * @method PeriodoDePrueba[]    findAll()
 * @method PeriodoDePrueba[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeriodoDePruebaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PeriodoDePrueba::class);
    }

    public function save(PeriodoDePrueba $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PeriodoDePrueba $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PeriodoDePrueba[] Returns an array of PeriodoDePrueba objects
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

//    public function findOneBySomeField($value): ?PeriodoDePrueba
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
