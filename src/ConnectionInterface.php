<?php

namespace Maenbn\LdapLookup;

interface ConnectionInterface
{
    public function connect();

    public function close();
}
