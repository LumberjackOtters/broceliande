<?php

namespace App\Mapper;

use Symfony\Component\Ldap\Entry;
use Symfony\Component\Ldap\Adapter\CollectionInterface;
use App\Entity\Group;

class LdapGroupMapper implements GroupMapperInterface {

    public function toGroup(Entry $groupEntry): Group
    {
        $group = new Group($groupEntry->getDn());
        foreach ($groupEntry->getAttributes() as $name => $attribute) {
            $setter = 'set'.ucfirst($name);
            $group->$setter($attribute);
        }
        return $group;
    }

    public function toGroups(CollectionInterface $groupEntries): array
    {
        $groups = [];
        foreach ($groupEntries as $groupEntry) {
            $group = new Group($groupEntry->getDn());
            foreach ($groupEntry->getAttributes() as $name => $attribute) {
                $setter = 'set'.ucfirst($name);
                $group->$setter($attribute);
            }
            array_push($groups, $group);
        }
        return $groups;
    }
    

}