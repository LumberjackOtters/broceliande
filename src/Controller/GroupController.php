<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Ldap\Adapter\ExtLdap\Adapter;
use Symfony\Component\Ldap\Ldap;
use App\Repository\GroupRepositoryInterface;

class GroupController extends AbstractController
{

    private GroupRepositoryInterface $repository;
    public function __construct(
        GroupRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    #[Route('/groups', name: 'app_groups')]
    public function index(): Response
    {
        // var_dump($this->getUser()->getEntry()->getDn());
        // var_dump($this->getUser()->getEntry());
        // $ldap->bind("cn=admin,dc=example,dc=org", "adminpassword");
        // $query = $ldap->query('dc=example,dc=org', '(objectclass=top)');
        // $results = $query->execute()->toArray();

        $results = $this->repository->findAll();

        return $this->render('group/index.html.twig', [
            'controller_name' => 'GroupController',
            'groups' => $results
        ]);
    }

    #[Route('/group/{id}', name: 'show_group')]
    public function get(string $id): Response
    {
        // var_dump($this->getUser()->getEntry()->getDn());
        // var_dump($this->getUser()->getEntry());
        // $ldap->bind("cn=admin,dc=example,dc=org", "adminpassword");
        // $query = $ldap->query('dc=example,dc=org', '(objectclass=top)');
        // $results = $query->execute()->toArray();

        $result = $this->repository->findOneById($id);

        return $this->render('group/show.html.twig', [
            'controller_name' => 'GroupController',
            'group' => $result
        ]);
    }
}
