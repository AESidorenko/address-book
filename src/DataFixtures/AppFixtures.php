<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Contact;
use App\Entity\Country;
use App\Entity\Location;
use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $data = [
            ['Ben', 'Smith', '01/02/2000', 'Germany', 'Berlin', 'Kurfürstendamm', '1A', '00XXZZ-18', 'avollory-5004@yopmail.com', '+1 (234) 567-89-00'],
            ['Jonas', 'Johnson', '02/03/2000', 'Germany', 'Berlin', 'Tauentzienstrasse', '2B', '98du0-H2', 'ecoreseh-2046@yopmail.com', '+1 (234) 567-89-00'],
            ['Leon', 'Williams', '03/04/2000', 'Germany', 'Berlin', 'Potsdamer Platz', '3C', 'AA-BB-CC', 'yfagija-3131@yopmail.com', '+1 (234) 567-89-00'],
            ['Elias', 'Brown', '04/05/2000', 'Germany', 'Berlin', 'Friedrichstrasse', '4D', '123-Hj8', 'afazixit-2957@yopmail.com', '+1 (234) 567-89-00'],
            ['Finn', 'Jones', '05/06/2000', 'Germany', 'Berlin', 'Neue Schönhauser Strasse', '5E', 'PO-98Z', 'iddyxowud-5299@yopmail.com', '+1 (234) 567-89-00'],
        ];

        foreach ($data as $item) {
            $person = new Person();
            $person->setFirstName($item[0]);
            $person->setLastName($item[1]);
            $person->setBirthday(new \DateTime($item[2]));

            $country = new Country();
            $country->setTitle($item[3]);

            $location = new Location();

            $location->setCountry($country);
            $location->setCity($item[4]);

            $address = new Address();
            $address->setAddressStreet($item[5]);
            $address->setAddressNumber($item[6]);
            $address->setZipCode($item[7]);

            $address->setLocation($location);
            $person->addAddress($address);

            $contact = new Contact();
            $contact->setHeadline('Contact description');
            $contact->setEmail($item[8]);
            $contact->setPhone($item[9]);
            $person->addContact($contact);

            $manager->persist($person);
        }

        $manager->flush();
    }
}
