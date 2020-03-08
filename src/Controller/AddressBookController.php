<?php

namespace App\Controller;

use App\Entity\Person;
use App\Repository\PersonRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddressBookController extends Controller
{
    /**
     * @Route("/persons")
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
     * @param Person $person
     * @return Response
     */
    public function editOne(Person $person)
    {
        return $this->render(
            'person.show.html.twig',
            [
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
    public function deleteOne(Person $person)
    {
        return $this->render(
            'person.show.html.twig',
            [
                'person' => $person
            ]
        );
    }
}