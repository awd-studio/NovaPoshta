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
use NP\Entity\TrackList;
use NP\Exception\ErrorException;
use PHPUnit\Framework\TestCase;

class TrackListTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \NP\Entity\TrackList
     */
    private $instance;

    /**
     * @var string
     */
    private $track;


    /**
     * Settings up.
     * @throws \NP\Exception\ErrorException
     */
    public function setUp()
    {
        parent::setUp();

        $this->track = '01234567890123';
        $this->instance = new TrackList($this->track);
    }


    /**
     * @covers \NP\Entity\TrackList::__construct
     * @covers \NP\Entity\TrackList::addTrack
     *
     * @throws \NP\Exception\ErrorException
     */
    public function test__construct()
    {
        $track = new Track($this->track);

        $this->assertInstanceOf(TrackList::class, new TrackList($this->track));
        $this->assertInstanceOf(TrackList::class, new TrackList([$this->track]));
        $this->assertInstanceOf(TrackList::class, new TrackList(['DocumentNumber' => $this->track]));
        $this->assertInstanceOf(TrackList::class, new TrackList($track));

        $this->expectException(ErrorException::class);
        new TrackList(42);
    }


    /**
     * @covers \NP\Entity\TrackList::getAllTracks
     */
    public function testGetAllTracks()
    {
        $this->assertArrayHasKey(0, $this->instance->getAllTracks());
    }


    /**
     * @covers \NP\Entity\TrackList::addTrack
     * @covers \NP\Entity\TrackList::getTrack
     */
    public function testAddGetTrack()
    {
        $track = '12345678901234';
        $this->instance->addTrack($track);

        $this->assertEquals(new Track($track), $this->instance->getTrack($track));
    }
}
