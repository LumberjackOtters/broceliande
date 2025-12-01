<?php

namespace App\Repository;

use App\Entity\Group;
use Symfony\Component\Uid\Uuid;

interface GroupRepositoryInterface
{
    // /**
    //  * @param Post $post
    //  * @return void
    //  */
    // public function save(Post $post): void;

    /**
     * @param Uuid $id
     * @return Group|null
     */
    public function findOneById(string $id): ?Group;

    /**
     * @return array
     */
    public function findAll(): array;
}