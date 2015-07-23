<?php

return [

    'hostname' => env('LDAP_HOSTNAME'),

    'port' => env('LDAP_PORT', 389),

    'baseDn' => env('LDAP_BASE_DN'),

    'bindRdn' => env('LDAP_BIND_RDN'),

    'bindPassword' => env('LDAP_BIND_PASSWORD'),

    'version' => env('LDAP_VERSION')

];
