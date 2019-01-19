<?php
/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/NovaPoshta
 */

declare(strict_types=1); // strict mode

namespace AwdStudio\NovaPoshta;

interface ConfigInterface
{
    /**
     * Get entry point.
     *
     * @return string
     */
    public function getApiEntry(): string;

    /**
     * Get current config API key.
     *
     * @return string
     */
    public function getApiKey(): string;
}
