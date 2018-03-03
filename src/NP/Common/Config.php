<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

declare(strict_types=1); // strict mode


namespace NP\Common;

use NP\Exception\Error;
use NP\Http\DriverInterface;
use NP\Http\CurlDriver;
use NP\Http\GuzzleDriver;


/**
 * Class Config
 * @package NP\Entity
 */
class Config
{

    /**
     * Languages.
     */
    const LANGUAGE_UK = 'Uk'; // ToDo: Check right name "Uk" or "uk";
    const LANGUAGE_RU = 'Ru'; // ToDo: Check right name "Ru" or "ru";

    /**
     * @var string API key.
     */
    protected $key;

    /**
     * @var DriverInterface HTTP driver.
     */
    protected $driver;

    /**
     * @var string Default language.
     */
    protected $language;

    /**
     * @var bool Soft mode.
     * Use for enable exceptions instead error response.
     */
    protected $softMode = true;

    /**
     * @var Error[]
     */
    protected $errors = [];


    /**
     * Config constructor.
     *
     * @param string|array $config Config data. May use array to set configs
     */
    protected function __construct($config)
    {
        if (is_string($config)) {
            $this->key = $config;
        } elseif (is_array($config) && isset($config['key'])) {
            foreach ($config as $k => $value) {
                $this->setProperty($k, $value);
            }
        } else {
            $this->errors[] = new Error('API key is not allowed.');
        }

        $this->setDefaults();
    }


    /**
     * Set up.
     *
     * @param mixed $config Config data. May use array to set configs
     *
     * @return Config
     */
    public static function setUp($config): Config
    {
        return new static($config);
    }


    /**
     * Set defaults.
     */
    private function setDefaults()
    {
        // Set default HTTP driver
        if (!$this->driver) {
            $this->setDefaultDriver();
        }

        // Set default language
        if (!$this->language) {
            $this->language = self::LANGUAGE_UK;
        }
    }


    /**
     * Set static field.
     *
     * @param $name
     * @param $value
     */
    public function setProperty($name, $value)
    {
        $this->$name = $value;
    }


    /**
     * Get default HTTP driver.
     *
     * ToDo: Refactor;
     * ToDo: Make test-friendly & testable at all;
     */
    private function setDefaultDriver()
    {
        try {
            $this->driver = new GuzzleDriver();
        } catch (\Exception $exception) {
            try {
                $this->driver = new CurlDriver();
            } catch (\Exception $exception) {
                $this->errors[] = new Error('There are no installed "Guzzle" library or "php_curl" extension!');
            }
        }
    }


    /**
     * Get errors.
     *
     * @return Error[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }


    /**
     * Get HTTP driver.
     *
     * @return DriverInterface
     */
    public function getDriver(): DriverInterface
    {
        return $this->driver;
    }


    /**
     * Get API key.
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }


    /**
     * Get default language.
     *
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }
}
