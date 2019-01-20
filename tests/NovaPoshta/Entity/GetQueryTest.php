<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace AwdStudio\NovaPoshta\Test\Entity;

use AwdStudio\NovaPoshta\Entity\GetQuery;
use AwdStudio\NovaPoshta\Test\Stubs\Method\StubMethodGet;
use PHPUnit\Framework\TestCase;

class GetQueryTest extends TestCase
{

    /**
     * Instance.
     *
     * @var GetQuery
     */
    private $instance;

    /** @var \AwdStudio\NovaPoshta\Method\MethodGetInterface */
    private $method;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->method = new StubMethodGet();
        $this->instance = new GetQuery($this->method);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\GetQuery::__construct
     */
    public function test__construct()
    {
        $instance = new GetQuery($this->method);

        $this->assertInstanceOf(GetQuery::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\GetQuery::generateQuery
     */
    public function testGenerateQuery()
    {
        $instance = $this->instance->generateQuery([]);

        $this->assertInstanceOf(\Generator::class, $instance);
    }

    /**
     * @covers \AwdStudio\NovaPoshta\Entity\GetQuery::buildQuery
     * @covers \AwdStudio\NovaPoshta\Entity\GetQuery::generateQuery
     */
    public function testBuildQuery()
    {
        $query = 'stubModelGet/stubMethodGet/model/method/orders[]/1234567891234/orders[]/1234567891235/test/data/apiKey/MY_KEY';

        $data = $this->instance->buildQuery();

        $this->assertIsString($data);
        $this->assertEquals($query, $data);
    }

}
