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


    /**
     * @covers \NP\Model\Address::getCitiesAction
     */
    public function testGetCitiesAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getCitiesAction());
    }


    /**
     * @covers \NP\Model\Address::saveAction
     */
    public function testSaveAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->saveAction());
    }


    /**
     * @covers \NP\Model\Address::updateAction
     */
    public function testUpdateAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->updateAction());
    }


    /**
     * @covers \NP\Model\Address::deleteAction
     */
    public function testDeleteAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->deleteAction());
    }


    /**
     * @covers \NP\Model\Address::getSettlementsAction
     */
    public function testGetSettlementsAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getSettlementsAction());
    }


    /**
     * @covers \NP\Model\Address::getAreasAction
     */
    public function testGetAreasAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getAreasAction());
    }


    /**
     * @covers \NP\Model\Address::getWarehousesAction
     */
    public function testGetWarehousesAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getWarehousesAction());
    }


    /**
     * @covers \NP\Model\Address::getWarehouseTypesAction
     */
    public function testGetWarehouseTypesAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getWarehouseTypesAction());
    }


    /**
     * @covers \NP\Model\Address::getStreetAction
     */
    public function testGetStreetAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->getStreetAction());
    }


    /**
     * @covers \NP\Model\Address::searchSettlementStreetsAction
     */
    public function testSearchSettlementStreetsAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->searchSettlementStreetsAction());
    }

}
