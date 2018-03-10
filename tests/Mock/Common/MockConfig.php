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


namespace NP\Mock\Common;

use NP\Common\Config;


/**
 * Class MockConfig
 * @package Mock\Common
 */
class MockConfig extends Config
{

    /**
     * @var array
     */
    protected $ignoredDriver = [];


    /**
     * MockConfig constructor.
     * @param        $config
     * @param array  $ignoredDriver
     */
    public function __construct($config, array $ignoredDriver)
    {
        $this->ignoredDriver = $ignoredDriver;

        parent::__construct($config);
    }


    /**
     * @param string $needle
     * @return bool
     */
    protected function inArray(string $needle)
    {
        return in_array($needle, $this->ignoredDriver);
    }


    /**
     * Check Guzzle availability.
     *
     * @return bool
     */
    public function isGuzzle(): bool
    {
        return $this->inArray('GuzzleDriver') ? false : parent::isGuzzle();
    }


    /**
     * Check CURL availability.
     *
     * @return bool
     */
    public function isCurl(): bool
    {
        return $this->inArray('CurlDriver') ? false : parent::isCurl();
    }


}
