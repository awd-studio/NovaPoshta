<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

declare(strict_types=1); // strict mode

namespace NP\Test\Entity;

use PHPUnit\Framework\TestCase;
use NP\Entity\Track;

/**
 * Class TrackTest
 * @package NP\Test\Entity
 */
class TrackTest extends TestCase
{

    /**
     * Instance.
     *
     * @var Track
     */
    private $instance;

    /**
     * @var string
     */
    private $documentNumber = '00000000000000';

    /**
     * @var string
     */
    private $phone = '380000000000';

    /**
     * @var array
     */
    private $track;


    /**
     * Settings up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->track = [
            'DocumentNumber' => $this->documentNumber,
            'Phone'          => $this->phone,
        ];
        $this->instance = new Track($this->track);
    }


    /**
     * @covers \NP\Entity\Track::__construct
     */
    public function testTrack()
    {
        $track0 = new Track($this->track);
        $this->assertInstanceOf(Track::class, $track0);

        $track1 = new Track($this->documentNumber);
        $this->assertInstanceOf(Track::class, $track1);

        $track2 = new Track([$this->documentNumber]);
        $this->assertInstanceOf(Track::class, $track2);
    }


    /**
     * @covers \NP\Entity\Track::getId
     */
    public function testGetId()
    {
        $this->assertEquals($this->documentNumber, $this->instance->getId());
    }


    /**
     * @covers \NP\Entity\Track::setPhone()
     * @covers \NP\Entity\Track::getPhone()
     */
    public function testSetGetPhone()
    {
        $this->instance->setPhone($this->phone);
        $this->assertEquals($this->phone, $this->instance->getPhone());
    }


    /**
     * @covers \NP\Entity\Track::build()
     */
    public function testBuild()
    {
        $this->assertEquals($this->track, $this->instance->build());
    }


    /**
     * @covers \NP\Entity\Track::create
     */
    public function testCreate()
    {
        $this->assertEquals($this->instance, Track::create($this->track));
    }
}
