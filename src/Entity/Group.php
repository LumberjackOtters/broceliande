<?php

namespace App\Entity;

class Group
{
    private ?array $objectClass = null;

    private ?string $dn = null;

    private ?string $cn = null;

    private ?string $gidNumber = null;

    private ?array $memberUid = null;

    public function __construct(string $dn)
    {
        $this->dn = $dn;
    }

    public function getDn(): ?string
    {
        return $this->dn;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): static
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getObjectClass(): ?array
    {
        return $this->objectClass;
    }

    public function setObjectClass(?array $objectClass): static
    {
        $this->objectClass = $objectClass;

        return $this;
    }

    public function getCn(): ?string
    {
        return $this->cn;
    }

    public function setCn(?array $cn): static
    {
        $this->cn = $cn[0];

        return $this;
    }

    public function getGidNumber(): ?string
    {
        return $this->gidNumber;
    }

    public function setGidNumber(?array $gidNumber): static
    {
        $this->gidNumber = $gidNumber[0];

        return $this;
    }

    public function getMemberUid(): ?array
    {
        return $this->memberUid;
    }

    public function setMemberUid(?array $memberUid): static
    {
        $this->memberUid = $memberUid;

        return $this;
    }

//     public function __set($name, $val){
//       $this->$name = $val;
//    }
}
