<?php

namespace ShopBundle\Repository\Tax;

use Doctrine\ORM\EntityRepository;
use ShopBundle\Entity\Tax;
use ShopBundle\Repository\Tax\TaxRepositoryInterface;


class TaxRepository extends EntityRepository implements TaxRepositoryInterface
{
    public function save(Tax $tax): void
    {
        $this->_em->persist($tax);
        $this->_em->flush();
    }

    public function findByName(string $name): ?Tax
    {
        $qb = $this->_em->createQueryBuilder()
            ->select('t')
            ->from("ShopBundle:Tax", 't')
            ->where('t.name = :name');

        $qb->setParameter('name', (string)$name);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findByRate(float $rate): ?Tax
    {
        $qb = $this->_em->createQueryBuilder()
            ->select('t')
            ->from("ShopBundle:Tax", 't')
            ->where('t.rate = :rate');

        $qb->setParameter('rate', (string)$rate);

        return $qb->getQuery()->getOneOrNullResult();
    }
}