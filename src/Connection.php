<?php

namespace Maenbn\LdapLookup;


class Connection implements ConnectionInterface {


    public $config;

    public $connection;


    public function __construct($config)
    {

        $this->config = $config;

    }

    public function connect()
    {

        $this->connection = ldap_connect($this->config['hostname'], $this->config['port'])
        or die("Couldn't connect to AD!");
        
        ldap_set_option($this->connection, LDAP_OPT_PROTOCOL_VERSION, 3);

        $bind = ldap_bind($this->connection, $this->config['bindRdn'], $this->config['bindPassword']);


        return $bind;

    }

    public function close()
    {

        ldap_close($this->connection);

    }

}
