<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Util;


/**
 * Singleton Trait.
 *
 * Avoid many instances of Singleton.
 */
trait Singleton
{

    /**
     * Settings instance.
     */
    private static $instance;


    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    private final function __construct() {}


    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    private final function __clone() {}


    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    private final function __wakeup() {}


    /**
     * Get Singleton instance.
     *
     * @return self
     */
    public final static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }
}
