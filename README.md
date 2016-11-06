CountryList
==========

A simple Laravel 5 service provider for the [umpirsky/country-list](https://github.com/umpirsky/country-list) localized countries arrays.

## Installation

Add the following line to the `require` section of `composer.json`:

```json
{
    "require": {
        "vcarreira/country-list": "~1.0"
    }
}
```

## Setup

In `/config/app.php`, add the following to `providers`:

  ```
  CountryList\CountryListServiceProvider::class,
  ```

  and the following to `aliases`:

  ```
  'CountryList' => CountryList\Facades\CountryListFacade::class,
  ```

## Usage

To use the service within your app, you need to retrieve it from the [Laravel IoC
Container](http://laravel.com/docs/ioc). The following example uses the `app` helper to retrieve the list of countries in Portuguese.

```php
    $countries = app('countrylist')->all('pt_PT');
```
If the facade is registered within the `aliases` section of the application configuration, you can also use the following code:

```php
  $countries = CountryList::all('pt_PT');
```
