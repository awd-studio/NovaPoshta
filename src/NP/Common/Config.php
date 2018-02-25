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
    const LANGUAGE_UK = 'Uk';
    const LANGUAGE_RU = 'Ru';

    /**
     * @var string API key.
     */
    protected static $key;

    /**
     * @var DriverInterface HTTP driver.
     */
    protected static $driver;

    /**
     * @var string Default language.
     */
    protected static $language;

    /**
     * @var bool Soft mode.
     * Use for enable exceptions instead error response.
     */
    protected static $softMode = true;

    /**
     * @var Error[]
     */
    protected static $errors = [];


    /**
     * Set up.
     *
     * @param mixed $config Config data. May use array to set configs
     *
     * @return Config
     */
    public static function setUp($config): Config
    {
        $self = new static();

        if (is_string($config)) {
            $self::$key = $config;
        } elseif (is_array($config) && isset($config['key'])) {
            foreach ($config as $k => $value) {
                $self::setProperty($k, $value);
            }
        } else {
            static::$errors[] = new Error('API key is not allowed.');
        }

        static::setDefaults();

        return $self;
    }


    /**
     * Set defaults.
     */
    private static function setDefaults()
    {
        // Set default HTTP driver
        if (!static::$driver) {
            static::setDefaultDriver();
        }

        // Set default language
        if (!self::$language) {
            self::$language = self::LANGUAGE_UK;
        }
    }


    /**
     * Set static field.
     *
     * @param $name
     * @param $value
     */
    public static function setProperty($name, $value)
    {
        self::${$name} = $value;
    }


    /**
     * Get default HTTP driver.
     *
     * ToDo: Refactor;
     * ToDo: Make test-friendly & testable at all;
     */
    private static function setDefaultDriver()
    {
        try {
            static::$driver = new GuzzleDriver();
        } catch (\Exception $exception) {
            try {
                static::$driver = new CurlDriver();
            } catch (\Exception $exception) {
                self::$errors[] = new Error('There are no installed "Guzzle" library or "php_curl" extension!');
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
        return self::$errors;
    }


    /**
     * Get HTTP driver.
     *
     * @return DriverInterface
     */
    public function getDriver(): DriverInterface
    {
        return self::$driver;
    }


    /**
     * Get API key.
     *
     * @return string
     */
    public function getKey(): string
    {
        return self::$key;
    }


    /**
     * Get default language.
     *
     * @return string
     */
    public static function getLanguage(): string
    {
        return self::$language;
    }
}
