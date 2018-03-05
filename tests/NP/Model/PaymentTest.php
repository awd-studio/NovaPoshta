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

use NP\Model\Payment;
use NP\Model\Model;
use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Model\Payment
     */
    private $instance;


    /**
     * Settings up.
     * @throws \NP\Exception\ErrorException
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new Payment();
    }


    /**
     * @covers \NP\Model\Payment::getCardsAction
     */
    public function testGetCardsAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getCardsAction());
    }

}
