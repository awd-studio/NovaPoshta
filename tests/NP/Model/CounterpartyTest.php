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

use NP\Model\Counterparty;
use NP\Model\Model;
use PHPUnit\Framework\TestCase;

class CounterpartyTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Model\Counterparty
     */
    private $instance;


    /**
     * Settings up.
     * @throws \NP\Exception\ErrorException
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new Counterparty();
    }


    /**
     * @covers \NP\Model\Counterparty::saveAction
     */
    public function testSaveAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->saveAction());
    }


    /**
     * @covers \NP\Model\Counterparty::updateAction
     */
    public function testUpdateAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->updateAction());
    }


    /**
     * @covers \NP\Model\Counterparty::deleteAction
     */
    public function testDeleteAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->deleteAction());
    }


    /**
     * @covers \NP\Model\Counterparty::getCounterpartyAddressesAction
     */
    public function testGetCounterpartyAddressesAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getCounterpartyAddressesAction());
    }


    /**
     * @covers \NP\Model\Counterparty::getCounterpartyOptionsAction
     */
    public function testGetCounterpartyOptionsAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getCounterpartyOptionsAction());
    }


    /**
     * @covers \NP\Model\Counterparty::getCounterpartyContactPersonAction
     */
    public function testGetCounterpartyContactPersonAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getCounterpartyContactPersonAction());
    }


    /**
     * @covers \NP\Model\Counterparty::getCounterpartiesAction
     */
    public function testGetCounterpartiesAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getCounterpartiesAction());
    }

}
