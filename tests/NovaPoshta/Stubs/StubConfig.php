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

namespace AwdStudio\NovaPoshta\Test\Stubs;

use AwdStudio\NovaPoshta\ConfigInterface;

/**
 * Stub class Config
 * @package AwdStudio\NovaPoshta\Test\Stubs
 */
class StubConfig implements ConfigInterface
{
    /**
     * API key for testing.
     *
     * @var string
     */
    const TEST_API_KEY = 'test-api-key';

    /**
     * Test URL.
     *
     * @var string
     */
    const TEST_URL = 'http://testapi.novaposhta.ua/';

    /**
     * Get entry point.
     *
     * @return string
     */
    public function getApiEntry(): string
    {
        return self::TEST_URL;
    }

    /**
     * Get current config API key.
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return self::TEST_API_KEY;
    }
}
