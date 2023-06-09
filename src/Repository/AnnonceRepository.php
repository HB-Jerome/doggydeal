<?php

namespace App\Repository;

use App\Entity\Annonce;
use App\Form\Filtre\FiltreAnnonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\OrderBy;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Annonce>
 *
 * @method Annonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonce[]    findAll()
 * @method Annonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonce::class);
    }

    public function save(Annonce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Annonce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Annonce[] Returns an array of Annonce objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Annonce
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function annonceList()
{
    return $this->createQueryBuilder('a')
        ->select(['a'])

        ->orderBy('a.modifiedAt', 'DESC')

        ->setMaxResults(5)

        ->getQuery()

        ->getResult()
    ;
}

public function filtreAnnonce(FiltreAnnonce $filtre): array
{
    $qb = $this->createQueryBuilder('a')

        ->leftJoin('a.dogs', 'dog')

        ->leftJoin('dog.races', 'race');

    if ($filtre->getIsLof()) {
        $qb->andWhere('dog.isLof=:isLof')->setParameter('isLof', $filtre->getIsLof());
    }
    if (!is_null($filtre->getRace())) {
        $qb->andWhere('race=:race')->setParameter('race', $filtre->getRace());
    }

    return $qb->getQuery()->getResult();
}
}
