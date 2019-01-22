<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace AwdStudio\NovaPoshta\Test\Method\Address;

use AwdStudio\NovaPoshta\Method\Address\SearchSettlements;
use AwdStudio\NovaPoshta\Method\Address\SearchSettlementsInterface;
use AwdStudio\NovaPoshta\Method\MethodInterface;
use AwdStudio\NovaPoshta\Model\ModelInterface;
use PHPUnit\Framework\TestCase;

class SearchSettlementsTest extends TestCase
{

    /**
     * Instance.
     *
     * @var SearchSettlements
     */
    private $instance;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new SearchSettlements();
        $this->instance->setCityName('CityName');
        $this->instance->setLimit(5);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Method\Address\SearchSettlements::setCityName
     */
    public function testSetCityName()
    {
        $instance = $this->instance->setCityName('CityName');

        $this->assertInstanceOf(SearchSettlementsInterface::class, $instance);
        $this->assertInstanceOf(ModelInterface::class, $instance);
        $this->assertInstanceOf(MethodInterface::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Method\Address\SearchSettlements::setLimit
     */
    public function testSetLimit()
    {
        $instance = $this->instance->setLimit(5);

        $this->assertInstanceOf(SearchSettlementsInterface::class, $instance);
        $this->assertInstanceOf(ModelInterface::class, $instance);
        $this->assertInstanceOf(MethodInterface::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Method\Address\SearchSettlements::getMethodProperties
     */
    public function testGetMethodProperties()
    {
        $properties = $this->instance->getMethodProperties();

        $this->assertIsArray($properties);
        $this->assertArrayHasKey('CityName', $properties);
        $this->assertArrayHasKey('Limit', $properties);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Method\Address\SearchSettlements::getCalledMethod
     */
    public function testGetCalledMethod()
    {
        $method = $this->instance->getCalledMethod();

        $this->assertEquals('searchSettlements', $method);
    }

}
