<?php

namespace App\Mapper;

use Symfony\Component\Ldap\Entry;
use Symfony\Component\Ldap\Adapter\CollectionInterface;
use App\Entity\Ou;

interface OuMapperInterface {

    public function toOu(Entry $ouEntry): Ou;

    public function toOus(CollectionInterface $ouEntries): array;

}