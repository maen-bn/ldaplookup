<?php

namespace Maenbn\LdapLookup\Facades;

use Illuminate\Support\Facades\Facade;

class LdapLookup extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'ldaplookup';
    }
}
