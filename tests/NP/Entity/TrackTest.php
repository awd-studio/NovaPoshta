<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Test\Entity;

use NP\Entity\Track;
use PHPUnit\Framework\TestCase;

class TrackTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Entity\Track
     */
    private $instance;

    /**
     * @var string
     */
    private $track;

    /**
     * @var string
     */
    private $phone;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->track = '01234567890123';
        $this->phone = '380112345678';
        $this->instance = new Track($this->track);
    }


    /**
     * @covers \NP\Entity\Track::__construct
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Track::class, new Track($this->track));
        $this->assertInstanceOf(Track::class, new Track($this->track, $this->phone));
        $this->assertInstanceOf(Track::class, new Track([$this->track]));
        $this->assertInstanceOf(Track::class, new Track([
            'DocumentNumber' => $this->track,
            'Phone' => $this->phone,
        ]));
    }


    /**
     * @covers \NP\Entity\Track::getId
     */
    public function testGetId()
    {
        $this->assertEquals($this->track, $this->instance->getId());
    }


    /**
     * @covers \NP\Entity\Track::setPhone
     * @covers \NP\Entity\Track::getPhone
     */
    public function testSetGetPhone()
    {
        $this->instance->setPhone($this->phone);
        $this->assertEquals($this->phone, $this->instance->getPhone());
    }


    /**
     * @covers \NP\Entity\Track::build
     */
    public function testBuild()
    {
        $this->instance->setPhone($this->phone);
        $array = $this->instance->build();

        $this->assertArrayHasKey('DocumentNumber', $array);
        $this->assertArrayHasKey('Phone', $array);
    }


    /**
     * @covers \NP\Entity\Track::create
     */
    public function testCreate()
    {
        $this->assertInstanceOf(Track::class, Track::create($this->track));
    }
}
