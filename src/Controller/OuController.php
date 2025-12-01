<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Ldap\Adapter\ExtLdap\Adapter;
use Symfony\Component\Ldap\Ldap;
use App\Repository\OuRepositoryInterface;

class OuController extends AbstractController
{

    private OuRepositoryInterface $repository;
    public function __construct(
        OuRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    #[Route('/ous', name: 'app_ous')]
    public function index(): Response
    {
        // var_dump($this->getUser()->getEntry()->getDn());
        // var_dump($this->getUser()->getEntry());
        // $ldap->bind("cn=admin,dc=example,dc=org", "adminpassword");
        // $query = $ldap->query('dc=example,dc=org', '(objectclass=top)');
        // $results = $query->execute()->toArray();

        $results = $this->repository->findAll();

        return $this->render('ou/index.html.twig', [
            'controller_name' => 'OuController',
            'ous' => $results
        ]);
    }

    #[Route('/ou/{id}', name: 'show_ou')]
    public function get(string $id): Response
    {
        // var_dump($this->getUser()->getEntry()->getDn());
        // var_dump($this->getUser()->getEntry());
        // $ldap->bind("cn=admin,dc=example,dc=org", "adminpassword");
        // $query = $ldap->query('dc=example,dc=org', '(objectclass=top)');
        // $results = $query->execute()->toArray();

        $result = $this->repository->findOneById($id);

        return $this->render('ou/show.html.twig', [
            'controller_name' => 'OuController',
            'ou' => $result
        ]);
    }
}
