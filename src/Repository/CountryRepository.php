<?php

namespace App\Repository;

use App\Entity\Country;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class CountryRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(Country::class));
    }

    /**
     * @param string $title
     * @return Country|null
     */
    public function findOneByCountryTitle(string $title)
    {
        return $this->findOneBy(['title' => $title]);
    }
}