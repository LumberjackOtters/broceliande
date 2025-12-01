<?php


namespace App\Repository;


use App\Entity\Ou;
use App\Repository\OuRepositoryInterface;
use Symfony\Component\Ldap\LdapInterface;
use App\Mapper\OuMapperInterface;
use Exception;
use Symfony\Component\Uid\Uuid;

class LdapOuRepository implements OuRepositoryInterface
{
    private LdapInterface $ldap;
    private OuMapperInterface $mapper;

    /**
     * NeighbourInFileRepository constructor.
     *
     * @param LdapInterface $ldap
     * @param OuMapperInterface $mapper
     */
    public function __construct(LdapInterface $ldap, OuMapperInterface $mapper)
    {
        $this->ldap = $ldap;
        $this->mapper = $mapper;
    }

    // public function save(Ou $Ou): void
    // {
    //     // $fileContent = $this->mapper->toInFile($Ou);
    //     // $this->filesystemHandler->createFile($post->getId(), $fileContent);
    // }

    /**
     * @throws Exception
     */
    public function findOneById(string $id): ?Ou
    {
        $this->ldap->bind();
        $query = $this->ldap->query('dc=example,dc=org', "(&(gidNumber={$id})(|(objectclass=organizationalUnit)(objectclass=posixOu)))");
        $results = $query->execute();

        if(count($results) < 1) return NULL;

        return $this->mapper->toOu($results[0]);
    }


    /**
     * @throws Exception
     */
    public function findAll(): array
    {
        $this->ldap->bind();
        $query = $this->ldap->query('dc=example,dc=org', '(|(objectclass=posixOu)(objectclass=organizationalUnit))');
        $results = $query->execute();

        if(count($results) < 1) return [];

        return $this->mapper->toOus($results);
    }
}