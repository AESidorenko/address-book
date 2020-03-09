<?php

namespace App\Controller;

use App\Entity\Country;
use App\Entity\Person;
use App\Forms\PersonType;
use App\Repository\CountryRepository;
use App\Repository\PersonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddressBookController extends Controller
{
    /**
     * @Route("/persons", name="persons.list")
     * @param Request          $request
     * @param PersonRepository $personRepository
     * @return Response
     */
    public function listPersons(Request $request, PersonRepository $personRepository, PaginatorInterface $paginator)
    {
        $query = $personRepository->getFindAllQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            3
        );

        $result = $query->getResult();

        return $this->render(
            'persons.html.twig',
            [
                'pagination' => $pagination
            ]
        );
    }

    /**
     * @Route("/persons/{id}/show", name="person.show")
     * @ParamConverter("person", class="App\Entity\Person")
     * @param Person $person
     * @return Response
     */
    public function showOne(Person $person)
    {
        return $this->render(
            'person.show.html.twig',
            [
                'person' => $person
            ]
        );
    }

    /**
     * @Route("/persons/{id}/edit", name="person.edit")
     * @ParamConverter("person", class="App\Entity\Person")
     * @param Request                $request
     * @param Person                 $person
     * @param EntityManagerInterface $entityManager
     * @param CountryRepository      $countryRepository
     * @return Response
     */
    public function editOne(
        Request $request,
        Person $person,
        EntityManagerInterface $entityManager,
        CountryRepository $countryRepository
    )
    {
        $originalCountries = [];
        foreach ($person->getAddresses() as $address) {
            $originalCountries[$address->getId()] = $address->getLocation()->getCountry()->getTitle();
        }

        $form = $this->createForm(PersonType::class, $person);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Person $person */
            $person = $form->getData();

            foreach ($person->getAddresses() as $address) {
                $country = $address->getLocation()->getCountry();
                if (array_key_exists($address->getId(), $originalCountries) &&
                    $originalCountries[$address->getId()] !== $country->getTitle()) {
                    $newCountry = $countryRepository->findOneByCountryTitle($country->getTitle());
                    if ($newCountry === null) {
                        $newCountry = (new Country())->setTitle($country->getTitle());
                    }

                    $address->getLocation()->setCountry($newCountry);

                    $entityManager->detach($country);
                    $entityManager->persist($newCountry);
                }
            }

            $entityManager->flush();
        }

        return $this->render(
            'person.edit.html.twig',
            [
                'form'   => $form->createView(),
                'person' => $person
            ]
        );
    }

    /**
     * @Route("/persons/new", name="person.new")
     * @param Request $request
     * @return Response
     */
    public function newOne(Request $request)
    {
        $person = new Person();

        $form = $this->createForm(PersonType::class, $person);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $person = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($person);
            $entityManager->flush();
        }

        return $this->render(
            'person.edit.html.twig',
            [
                'form'   => $form->createView(),
                'person' => $person
            ]
        );
    }

    /**
     * @Route("/persons/{id}/delete", name="person.delete")
     * @ParamConverter("person", class="App\Entity\Person")
     * @param Person $person
     * @return Response
     */
    public
    function deleteOne(Person $person)
    {
        return $this->render(
            'person.show.html.twig',
            [
                'person' => $person
            ]
        );
    }
}