<?php namespace Maenbn\LdapLookup;

use Maenbn\LdapLookup\Connection as LdapConnection;

class LdapLookup implements LookupInterface {

    protected $connection;

    public $connected = false;

    protected $config;

    public function __construct(LdapConnection $connection)
    {
        $this->connection = $connection;

        $this->config = $connection->config;

        $this->connect();

    }

    public function connect()
    {

        $this->connected = $this->connection->connect();

        return $this;

    }

    protected function search($filter)
    {

        return ldap_search($this->connection->connection, $this->config['basedn'], $filter);

    }

    protected function getEntries($resultsId, $type = null)
    {

        $info = ldap_get_entries($this->connection->connection, $resultsId);

        $entries =  [];

        for ($i = 0; $i < $info["count"]; $i ++)
        {
            $entry = [];

            foreach($info[$i] as $key => $value)
            {

                if(is_string($key)){
                    $entry[$key] = $value[0];
                }

            }
            $entries[] = $entry;
        }

        switch ($type)
        {
            case 'first':
                $entries = $entries[0];
                break;

        }

        return $entries;

    }

    public function getByUid($uid)
    {

        $filter = "uid=" . $uid;

        $resultsId = $this->search($filter);
        $entries = $this->getEntries($resultsId, 'first');

        return $entries;


    }

}