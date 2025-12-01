<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Ldap\Adapter\ExtLdap\Adapter;
use Symfony\Component\Ldap\Ldap;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Ldap $ldap): Response
    {
        // var_dump($this->getUser());

        // var_dump($this->getUser()->getEntry()->getDn());
        // var_dump($this->getUser()->getEntry());
        $ldap->bind("cn=admin,dc=example,dc=org", "adminpassword");
        $query = $ldap->query('dc=example,dc=org', '(objectclass=top)');
        $results = $query->execute()->toArray();


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'results' => $results
        ]);
    }
}
