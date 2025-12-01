<?php

namespace App\Repository;

use App\Entity\User;
use Symfony\Component\Uid\Uuid;

interface UserRepositoryInterface
{
    // /**
    //  * @param Post $post
    //  * @return void
    //  */
    // public function save(Post $post): void;

    /**
     * @param string $id
     * @return User|null
     */
    public function findOneById(string $id): ?User;
}