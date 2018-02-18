<?php

/**
 * @file
 * This file is part of Test Projects PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/test-projects
 */

declare(strict_types=1); // strict mode


namespace NP\Common\Util;


/**
 * Helper trait.
 * @package NP\Common\Util
 */
trait Helper
{

    /**
     * Convert string to specific style.
     *
     * @param string $string
     *
     * @return string
     */
    public function toActionCase(string $string): string
    {
        return mb_strtolower($string);
    }
}
