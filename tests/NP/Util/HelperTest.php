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

namespace NP\Test\Util;

use NP\Util\Helper;
use PHPUnit\Framework\TestCase;

/**
 * Class TestHelper
 * @package NP\Util
 */
class HelperTest extends TestCase
{
    use Helper;


    /**
     * @covers \NP\Util\Helper::toActionCase
     */
    public function testToActionCase()
    {
        $string = 'TexTwiThmIXedCaSe';
        $expected = mb_strtolower($string);

        $this->assertEquals($expected, $this->toActionCase($string));
    }
}
