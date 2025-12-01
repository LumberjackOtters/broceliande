<?php

namespace App\Repository;

use App\Entity\Ou;
use Symfony\Component\Uid\Uuid;

interface OuRepositoryInterface
{
    // /**
    //  * @param Post $post
    //  * @return void
    //  */
    // public function save(Post $post): void;

    /**
     * @param Uuid $id
     * @return Ou|null
     */
    public function findOneById(string $id): ?Ou;

    /**
     * @return array
     */
    public function findAll(): array;
}