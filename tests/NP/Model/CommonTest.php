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

use NP\Model\Common;
use NP\Model\Model;
use PHPUnit\Framework\TestCase;

class CommonTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Model\Common
     */
    private $instance;


    /**
     * Settings up.
     * @throws \NP\Exception\ErrorException
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new Common();
    }


    /**
     * @covers \NP\Model\Common::getTimeIntervalsAction
     */
    public function testGetTimeIntervalsAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getTimeIntervalsAction());
    }


    /**
     * @covers \NP\Model\Common::getCargoTypesAction
     */
    public function testGetCargoTypesAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getCargoTypesAction());
    }


    /**
     * @covers \NP\Model\Common::getBackwardDeliveryCargoTypesAction
     */
    public function testGetBackwardDeliveryCargoTypesAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getBackwardDeliveryCargoTypesAction());
    }


    /**
     * @covers \NP\Model\Common::getPalletsListAction
     */
    public function testGetPalletsListAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getPalletsListAction());
    }


    /**
     * @covers \NP\Model\Common::getTypesOfPayersAction
     */
    public function testGetTypesOfPayersAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getTypesOfPayersAction());
    }


    /**
     * @covers \NP\Model\Common::getTypesOfPayersForRedeliveryAction
     */
    public function testGetTypesOfPayersForRedeliveryAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getTypesOfPayersForRedeliveryAction());
    }


    /**
     * @covers \NP\Model\Common::getPackListAction
     */
    public function testGetPackListAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getPackListAction());
    }


    /**
     * @covers \NP\Model\Common::getTiresWheelsListAction
     */
    public function testGetTiresWheelsListAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getTiresWheelsListAction());
    }


    /**
     * @covers \NP\Model\Common::getCargoDescriptionListAction
     */
    public function testGetCargoDescriptionListAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getCargoDescriptionListAction());
    }


    /**
     * @covers \NP\Model\Common::getMessageCodeTextAction
     */
    public function testGetMessageCodeTextAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getMessageCodeTextAction());
    }


    /**
     * @covers \NP\Model\Common::getServiceTypesAction
     */
    public function testGetServiceTypesAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getServiceTypesAction());
    }


    /**
     * @covers \NP\Model\Common::getTypesOfCounterpartiesAction
     */
    public function testGetTypesOfCounterpartiesAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getTypesOfCounterpartiesAction());
    }


    /**
     * @covers \NP\Model\Common::getPaymentFormsAction
     */
    public function testGetPaymentFormsAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getPaymentFormsAction());
    }


    /**
     * @covers \NP\Model\Common::getOwnershipFormsListAction
     */
    public function testGetOwnershipFormsListAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getOwnershipFormsListAction());
    }

}
