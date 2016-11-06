<?php

namespace CountryList;

use Illuminate\Support\ServiceProvider;

/**
 * Service provider for the {@link https://github.com/umpirsky/country-list localized countries}.
 *
 * @author     Vitor Carreira
 *
 * @link       https://github.com/vcarreira
 */
class CountryListServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the configuration.
     */
    public function boot()
    {
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->addBindings();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [CountryList::class];
    }

    private function addBindings()
    {
        $this->app->singleton('countrylist', function () {
            return new CountryList();
        });
    }
}
