<?php namespace Orchestra\Testbench\TestCase;

class LdapLookupTest extends \Orchestra\Testbench\TestCase
{
    protected $config;

    protected function getEnvironmentSetUp($app)
    {
        $config = $this->mockLdapLookupConfig();

        $this->config = $config;

        $app['config']->set('ldaplookup.hostname', $config['hostname']);
        $app['config']->set('ldaplookup.port', $config['port']);
        $app['config']->set('ldaplookup.baseDn', $config['baseDn']);
        $app['config']->set('ldaplookup.bindRdn', $config['bindRdn']);
        $app['config']->set('ldaplookup.bindPassword', $config['bindPassword']);
    }

    protected function mockLdapLookupConfig()
    {
        $configFile = dirname(__FILE__) . '/config.php';

        if (!file_exists($configFile)) {
            $this->fail('Please take the config.php.dist and create a config.php file ' .
                'with your LDAP server details within the same directory');
        }

        return include $configFile;
    }

    protected function getPackageProviders($app)
    {
        return [
            'Maenbn\LdapLookup\LdapLookupServiceProvider',
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'LdapLookup' => 'Maenbn\LdapLookup\Facades\LdapLookup',
        ];
    }

    public function testFacadeCanBeResolvedToServiceInstance()
    {
        $ldapLookup = \LdapLookup::connect();

        $this->assertInstanceOf('Maenbn\LdapLookup\LdapLookup', $ldapLookup);
    }

    public function testConnection()
    {
        $ldapLookup = \LdapLookup::connect();

        $this->assertTrue($ldapLookup->connected);
    }

    public function testGetByUid()
    {
        $entry = \LdapLookup::getByUid($this->config['test_user']);
        $this->assertArrayHasKey('cn', $entry);
    }
}
