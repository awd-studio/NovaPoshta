<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace AwdStudio\NovaPoshta\Test\Model;

use AwdStudio\NovaPoshta\Model\Orders;
use PHPUnit\Framework\TestCase;

class OrdersTest extends TestCase
{

    /**
     * Instance.
     *
     * @var Orders
     */
    private $instance;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new Orders();
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Model\Orders::getModelName
     */
    public function testGetModelName()
    {
        $data = $this->instance->getModelName();

        $this->assertEquals('orders', $data);
    }

}
