<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace AwdStudio\NovaPoshta\Test\Model\Address;

use AwdStudio\NovaPoshta\Model\Address;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{

    /**
     * Instance.
     *
     * @var Address
     */
    private $instance;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new Address();
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Model\Address::getModelName
     */
    public function testGetModelName()
    {
        $modelName = $this->instance->getModelName();

        $this->assertIsString($modelName);
        $this->assertEquals('Address', $modelName);
    }

}
