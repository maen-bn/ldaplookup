# LDAP Lookup
=================
LDAP lookup is a simple LDAP entries lookup provider for use with in Laravel 5

## Installation

The tool requires you have [PHP](https://php.net) 5.4.*+ and [Composer](https://getcomposer.org).

The get the latest version of LDAP lookup, add the following line to your `composer.json` file:
```
"maenbn\ldaplookup": "dev-master"
```

Then run `composer install` or `composer update` to install.

You will also need to register the service provider by going into `config/app.php` and add the following to the `providers` key:
```
'Maenbn\LdapLookup\LdapLookupServiceProvider'
```
And you can also register the facade in the `aliases key in the same file like so:

```
'LdapLookup' => 'Maenbn\LdapLookup\Facades\LdapLookup'
```

## Configuration

A configuration for your LDAP server is required for the LdapLookup to work. First publish all vendor assets:

```bash
$ php artisan vendor:publish
```
which will create a `config/ldaplookup.php` file in your app where you can modify it to reflect your LDAP server `hostname`, `port`, `baseDn`, `bindRdn`, and `bindPassword`.

## Usage

You can search for an indivdual user by carrying out the following:
```php
//Find the user with the test123 username
LdapLookup::getByUid('test123'); // will return an array
```
You can also run your own custom search by doing the following:
```php
LdapLookup::runSearch('mail=test*','first'); // will return first entry
LdapLookup::runSearch('mail=test*'); // will return all entries
```
