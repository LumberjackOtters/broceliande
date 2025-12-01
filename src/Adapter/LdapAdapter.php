<?php

namespace App\Adapters;

use Symfony\Component\Ldap\LdapInterface;
use Symfony\Component\Ldap\Adapter\AdapterInterface;
use Symfony\Component\Ldap\Adapter\EntryManagerInterface;
use Symfony\Component\Ldap\Adapter\ExtLdap\Adapter;
use Symfony\Component\Ldap\Adapter\QueryInterface;
use Symfony\Component\Ldap\Exception\DriverNotFoundException;

class LdapAdapter implements LdapInterface
{
    public const OBJECT_CLASS = "top";

    private Adapter $adapter;

    private string $bindDn;
    private string $bindPassword;

    public function __construct(Adapter $adapter, #[Autowire(param: 'env(BIND_DN)')] string $bindDn, #[Autowire(param: 'env(BIND_PASSWORD)')] string $bindPassword)
    {
        $this->adapter = $adapter;
        $this->bindDn = $bindDn;
        $this->bindPassword = $bindPassword;
    }

    public function bind(?string $dn = null, #[\SensitiveParameter] ?string $password = null): void
    {
        if ($dn === null && $password === null) {
            $dn = $this->bindDn;
            $password = $this->bindPassword;
        }
        $this->adapter->getConnection()->bind($dn, $password);
    }

    public function query(string $dn, string $query, array $options = []): QueryInterface
    {
        return $this->adapter->createQuery($dn, $query, $options);
    }

    public function getEntryManager(): EntryManagerInterface
    {
        return $this->adapter->getEntryManager();
    }

    public function escape(string $subject, string $ignore = '', int $flags = 0): string
    {
        return $this->adapter->escape($subject, $ignore, $flags);
    }

    /**
     * Creates a new Ldap instance.
     *
     * @param string $adapter The adapter name
     * @param array  $config  The adapter's configuration
     */
    public static function create(string $adapter, array $config = []): static
    {
        if ('ext_ldap' !== $adapter) {
            throw new DriverNotFoundException(sprintf('Adapter "%s" not found. Only "ext_ldap" is supported at the moment.', $adapter));
        }

        return new self(new Adapter($config));
    }
}