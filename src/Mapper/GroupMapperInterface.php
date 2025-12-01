<?php

namespace App\Mapper;

use Symfony\Component\Ldap\Entry;
use Symfony\Component\Ldap\Adapter\CollectionInterface;
use App\Entity\Group;

interface GroupMapperInterface {

    public function toGroup(Entry $groupEntry): Group;

    public function toGroups(CollectionInterface $groupEntries): array;

}