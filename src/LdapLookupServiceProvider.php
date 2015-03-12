<?php namespace Maenbn\LdapLookup;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class LdapLookupServiceProvider extends ServiceProvider {

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/../config/ldaplookup.php');

        $this->publishes([$source => config_path('ldaplookup.php')]);

        $this->mergeConfigFrom($source, 'ldaplookup');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLdapLookup($this->app);
        $this->registerConnection($this->app);
    }

    protected function registerConnection(Application $app)
    {

       /* $app->singleton('ldaplookup.connection', function ($app)
        {

            $config = $app['config']['ldaplookup'];

            return new Connection($config);
        });*/

        $app->bind('ConnectionInterface', function ($app)
        {

            $config = $app['config']['ldaplookup'];

            return new Connection($config);
        });

        $app->alias('ldaplookup.connection', 'Maenbn\LdapLookup\Connection');

    }

    protected function registerLdapLookup(Application $app)
    {
        $app->singleton('ldaplookup', function ($app)
        {

            $connection = $app['ConnectionInterface'];

            return new LdapLookup($connection);
        });

        $app->alias('ldaplookup', 'Maenbn\LdapLookup\LdapLookup');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'ldaplookup',
            'Maenbn\LdapLookup\ConnectionInterface'
        ];
    }
}
