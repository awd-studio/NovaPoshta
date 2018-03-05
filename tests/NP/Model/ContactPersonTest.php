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

use NP\Model\ContactPerson;
use NP\Model\Model;
use PHPUnit\Framework\TestCase;

class ContactPersonTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Model\ContactPerson
     */
    private $instance;


    /**
     * Settings up.
     * @throws \NP\Exception\ErrorException
     */
    public function setUp()
    {
        parent::setUp();

        $this->instance = new ContactPerson();
    }


    /**
     * @covers \NP\Model\ContactPerson::saveAction
     */
    public function testSaveAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->saveAction());
    }


    /**
     * @covers \NP\Model\ContactPerson::updateAction
     */
    public function testUpdateAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->updateAction());
    }


    /**
     * @covers \NP\Model\ContactPerson::deleteAction
     */
    public function testDeleteAction()
    {
        $this->assertInstanceOf(Model::class, $this->instance->deleteAction());
    }

}
