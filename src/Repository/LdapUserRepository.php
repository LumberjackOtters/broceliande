<?php


namespace App\Repository;


use App\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Ldap\LdapInterface;
use App\Mapper\UserMapperInterface;
use Exception;
use Symfony\Component\Uid\Uuid;

class LdapUserRepository implements UserRepositoryInterface
{
    private LdapInterface $ldap;
    private UserMapperInterface $mapper;

    /**
     * NeighbourInFileRepository constructor.
     *
     * @param LdapInterface $ldap
     * @param UserMapperInterface $mapper
     */
    public function __construct(LdapInterface $ldap, UserMapper $mapper)
    {
        $this->ldap = $ldap;
        $this->mapper = $mapper;
    }

    // public function save(User $user): void
    // {
    //     // $fileContent = $this->mapper->toInFile($user);
    //     // $this->filesystemHandler->createFile($post->getId(), $fileContent);
    // }

    /**
     * @throws Exception
     */
    public function findOneById(string $id): ?User
    {
        $fileContent = $this->filesystemHandler->readFile($id->toRfc4122());
        if (is_null($fileContent)) return NULL;

        return $this->fileParser->toDomain($fileContent);
    }
}