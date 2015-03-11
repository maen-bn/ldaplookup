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

        $this->connection = ldap_connect($this->config['hostname']) or die("Couldn't connect to AD!");

        // Read only bind
        try {
        $readConnection = ldap_bind($this->connection);
        } catch( ErrorException $e ) {
            dd($e);
            // do stuff
        }

        //dd($readConnection);

        return $readConnection;

    }

    public function close()
    {

        ldap_close($this->connection);

    }

}