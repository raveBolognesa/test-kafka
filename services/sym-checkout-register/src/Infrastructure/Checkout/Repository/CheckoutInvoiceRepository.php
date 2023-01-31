<?php

namespace App\Infrastructure\Checkout\Repository;

use App\Domain\Checkout\Entity\CheckoutInvoice;
use App\Domain\Checkout\Repository\CheckoutInvoiceRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CheckoutInvoice>
 *
 * @method CheckoutInvoice|null find($id, $lockMode = null, $lockVersion = null)
 * @method CheckoutInvoice|null findOneBy(array $criteria, array $orderBy = null)
 * @method CheckoutInvoice[]    findAll()
 * @method CheckoutInvoice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CheckoutInvoiceRepository extends ServiceEntityRepository implements CheckoutInvoiceRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CheckoutInvoice::class);
    }

    public function save(CheckoutInvoice $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

    }

    public function remove(CheckoutInvoice $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CheckoutInvoice[] Returns an array of CheckoutInvoice objects
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

//    public function findOneBySomeField($value): ?CheckoutInvoice
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
