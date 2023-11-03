<?php

namespace App\Repository;

use App\Entity\Coment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Coment>
 *
 * @method Coment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coment[]    findAll()
 * @method Coment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coment::class);
    }

    public function findComents($id){
        return $this->getEntityManager()
            -> createQuery("
                SELECT coment.getItem, coment.coment FROM App:Coment coment WHERE coment.getItem =:id
            ")
            ->setParameter('id', $id)
            ->getResult();
       }

//    /**
//     * @return Coment[] Returns an array of Coment objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Coment
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
