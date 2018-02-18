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


namespace NP\Entity;

use NP\Exception\Errors;
use NP\Http\DriverInterface;
use NP\Http\CurlDriver;
use NP\Http\GuzzleDriver;
use NP\Common\Util\Singleton;


/**
 * Class Config
 * @package NP\Entity
 */
class Config
{
    use Singleton;

    /**
     * Languages.
     */
    const LANGUAGE_UK = 'Uk';
    const LANGUAGE_RU = 'Ru';

    /**
     * @var string API key.
     */
    private static $key;

    /**
     * @var DriverInterface HTTP driver.
     */
    private static $driver;

    /**
     * @var string Default language.
     */
    private static $language;

    /**
     * @var Errors NP errors.
     */
    private static $errors;


    /**
     * Set up.
     *
     * @param mixed  $config Config data. May use array to set configs
     * @param Errors $errors NP Errors
     *
     * @return Config
     */
    public static function setUp($config, Errors &$errors): self
    {
        self::$errors = &$errors;

        if (is_string($config)) {
            self::$key = $config;
        } elseif (is_array($config) && isset($config['key'])) {
            foreach ($config as $k => $value) {
                self::setProperty($k, $value);
            }
        } else {
            self::$errors->addError('API key is not allowed.', 7);
        }

        self::setDefaults();

        return self::getInstance();
    }


    /**
     * Set defaults.
     */
    private static function setDefaults()
    {
        // Set default HTTP driver
        if (!self::$driver) {
            self::$driver = self::getDefaultDriver();
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
     * @return DriverInterface
     */
    private static function getDefaultDriver(): DriverInterface
    {
        try {
            $driver = new GuzzleDriver;
        } catch (\Exception $exception) {
            try {
                $driver = new CurlDriver;
            } catch (\Exception $exception) {
                $driver = null;
                self::$errors->addError('', 2);
            }
        }

        return $driver;
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
