<?php

namespace CountryList\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for the country list service.
 *
 * @author     Vitor Carreira
 *
 * @link       https://github.com/vcarreira
 */
class CountryListFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'countrylist';
    }
}
