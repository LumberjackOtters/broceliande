<?php

namespace App\Entity;

class Ou
{
    private ?string $id = null;

    private ?string $name = null;

    public function __construct(string $id, string $ou)
    {
        $this->id = $id;
        $this->ou = $ou;
        // $this->content = $content;
        // $this->publishedAt = $publishedAt;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getOu(): ?string
    {
        return $this->ou;
    }

    public function setOu(?string $ou): static
    {
        $this->ou = $ou;

        return $this;
    }
}
