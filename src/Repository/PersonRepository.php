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
        return $this->createQueryBuilder('p')->getQuery();
    }

    public function getFindAllByNameCityAndCountry($name, $city, $country)
    {
        $query = $this->createQueryBuilder('p')
            ->andWhere("LOWER(p.firstName) LIKE :n")
            ->orWhere("LOWER(p.lastName) LIKE :n")
            ->setParameter('n', '%' . strtolower($name) . '%')
            ->setParameter('n', '%' . strtolower($name) . '%')

//            ->andWhere("LOWER(p.address.location.country.title) LIKE :country")
//            ->setParameter('country', '%' . strtolower($country) . '%')

            ->getQuery()
            ;

        return $query;
    }
}