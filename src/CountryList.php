<?php

namespace CountryList;

class CountryList
{
    /**
     * Location of the data directory.
     *
     * @var string
     */
    protected $dataDir;

    /**
     * Cached data.
     *
     * @var array
     */
    protected $cache = [];

    public function __construct($dataDir = null)
    {
        if (is_null($dataDir)) {
            $reflection = new \ReflectionClass(self::class);
            $dataDir = sprintf('%s/../../../umpirsky/country-list/data', dirname($reflection->getFileName()));
        }
        if (!is_dir($dataDir)) {
            throw new \RuntimeException('Invalid data dir "'.$dataDir.'"');
        }
        $this->dataDir = realpath($dataDir);
    }

    /**
     * Returns a list of all countries.
     *
     * @param string $locale The locale (default: en)
     * @param string $format The format (default: php)
     *
     * @return array
     */
    public function all($locale = 'en', $format = 'php')
    {
        return $this->load($locale, $format);
    }

    public function find($countryCode, $locale = 'en')
    {
        if (!$this->has($countryCode, $locale)) {
            return;
        }
        $data = $this->load($locale);

        return $data[mb_strtoupper($countryCode)];
    }

    public function has($countryCode, $locale = 'en')
    {
        $data = $this->load($locale);

        return isset($data[mb_strtoupper($countryCode)]);
    }

    /**
     * Lazy-loads data from a file if it is not stored in memory yet.
     *
     * @param string $locale The locale
     * @param string $format The format (default: php)
     *
     * @return array An array (list) with country information
     */
    protected function load($locale = 'en', $format = 'php')
    {
        if (isset($this->cache[$locale][$format])) {
            return $this->cache[$locale][$format];
        }
        $filename = sprintf('%s/%s/country.%s', $this->dataDir, $locale, $format);
        if (!is_file($filename)) {
            throw new \RuntimeException('Country data file "'.$filename.'" not found');
        }

        $data = $format == 'php' ? require $filename : file_get_contents($filename);
        $this->sort($data, $locale);
        $this->cache[$locale][$format] = $data;

        return $data;
    }

    /**
     * Sorts the data array for a given locale, using the locale translations.
     * It is UTF-8 aware if the Collator class is available (requires the intl
     * extension).
     *
     * @param array  $data   Array of strings to sort.
     * @param string $locale The locale whose collation rules should be used.
     *
     * @return bool True on success; false on failure
     */
    protected function sort($data, $locale)
    {
        if (!is_array($data)) {
            return;
        }
        if (class_exists('Collator')) {
            $collator = new \Collator($locale);

            return $collator->asort($data);
        }

        return  asort($data);
    }
}
