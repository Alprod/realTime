<?php

namespace App\Repository;

use App\Entity\Reaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Reaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reaction[]    findAll()
 * @method Reaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reaction::class);
    }

    
    public function countReaction(int $sessionId): array
    {
        $rows = $this
            ->createQueryBuilder('r')
            ->select('r.type, COUNT(r.id) as nb')
            ->Where('r.session = :session_id')
            ->setParameter('session_id', $sessionId)
            ->groupBy('r.type')
            ->setMaxResults(10)
            ->getQuery()
            ->getArrayResult();

        $data = [];
        foreach ($rows as $row) {
            $data[$row['type']] = (int) $row['nb'];
        }
        return $data;
    }
    
    /*
    public function findOneBySomeField($value): ?Reaction
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
