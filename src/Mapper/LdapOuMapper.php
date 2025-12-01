<?php

namespace App\Mapper;

use Symfony\Component\Ldap\Entry;
use Symfony\Component\Ldap\Adapter\CollectionInterface;
use App\Entity\Ou;

class LdapOuMapper implements OuMapperInterface {

    public function toOu(Entry $ouEntry): Ou
    {
        return new Ou($ouEntry->getGid(), $ouEntry->getAttribute("cn")[0], $ouEntry->getDn());
    }

    public function toOus(CollectionInterface $ouEntries): array
    {
        $ous = [];
        foreach ($ouEntries as $ouEntry) {
            array_push($ous, new Ou($ouEntry->getDn(), $ouEntry->getAttribute("ou")[0]));
        }
        return $ous;
    }

}