<?php


namespace App\Repository;


use App\Entity\Group;
use App\Repository\GroupRepositoryInterface;
use Symfony\Component\Ldap\LdapInterface;
use App\Mapper\GroupMapperInterface;
use Exception;
use Symfony\Component\Uid\Uuid;

class LdapGroupRepository implements GroupRepositoryInterface
{
    private LdapInterface $ldap;
    private GroupMapperInterface $mapper;

    /**
     * NeighbourInFileRepository constructor.
     *
     * @param LdapInterface $ldap
     * @param GroupMapperInterface $mapper
     */
    public function __construct(LdapInterface $ldap, GroupMapperInterface $mapper)
    {
        $this->ldap = $ldap;
        $this->mapper = $mapper;
    }

    // public function save(Group $Group): void
    // {
    //     // $fileContent = $this->mapper->toInFile($Group);
    //     // $this->filesystemHandler->createFile($post->getId(), $fileContent);
    // }

    /**
     * @throws Exception
     */
    public function findOneById(string $id): ?Group
    {
        $this->ldap->bind();
        $query = $this->ldap->query('dc=example,dc=org', "(&(gidNumber={$id})(|(objectclass=group)(objectclass=posixGroup)))");
        $results = $query->execute();

        if(count($results) < 1) return NULL;

        return $this->mapper->toGroup($results[0]);
    }


    /**
     * @throws Exception
     */
    public function findAll(): array
    {
        $this->ldap->bind();
        $query = $this->ldap->query('dc=example,dc=org', '(|(objectclass=posixGroup)(objectclass=group))');
        $results = $query->execute();

        if(count($results) < 1) return [];

        return $this->mapper->toGroups($results);
    }
}