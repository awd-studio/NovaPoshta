<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Test\Model;

use NP\Model\Address;
use NP\Model\Model;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Model\Address
     */
    private $instance;


    /**
     * Settings up.
     * @throws \NP\Exception\ErrorException
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new Address();
    }


    /**
     * @covers \NP\Model\Address::searchSettlementsAction
     */
    public function testSearchSettlementsAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->searchSettlementsAction());
    }

}
