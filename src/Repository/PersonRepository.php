<?php

namespace App\Repository;

use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class PersonRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(Person::class));
    }

    public function getFindAllQuery()
    {
        return $this->createQueryBuilder('p')
                    ->orderBy('LOWER(p.firstName)')
                    ->addOrderBy('LOWER(p.lastName)')
                    ->getQuery();
    }
}