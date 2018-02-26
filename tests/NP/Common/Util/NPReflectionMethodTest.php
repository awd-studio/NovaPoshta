<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Test\Common\Util;

use NP\Common\Util\NPReflectionMethod;
use PHPUnit\Framework\TestCase;
use ReflectionException;

class NPReflectionMethodTest extends TestCase
{

    /**
     * @covers \NP\Common\Util\NPReflectionMethod::build
     * @throws \ReflectionException
     */
    public function testBuild()
    {
        $this->expectException(ReflectionException::class);
        NPReflectionMethod::build('unknownClass', 'unknownMethod');
    }
}
