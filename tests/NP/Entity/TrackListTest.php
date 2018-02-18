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

use Countable;
use Iterator;
use NP\Entity\Track;
use PHPUnit\Framework\TestCase;
use NP\Entity\TrackList;

/**
 * Class TrackListTest
 * @package NP\Test\Entity
 */
class TrackListTest extends TestCase
{

    /**
     * Instance.
     *
     * @var TrackList
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
        $this->instance = new TrackList($this->track);
    }


    /**
     * @covers \NP\Entity\TrackList::__construct
     */
    public function testTrackList()
    {
        $this->assertInstanceOf(TrackList::class, $this->instance);
        $this->assertInstanceOf(Iterator::class, $this->instance);
        $this->assertInstanceOf(Countable::class, $this->instance);

        new TrackList($this->documentNumber);
        new TrackList([$this->documentNumber]);
        new TrackList(new Track($this->documentNumber));

        new TrackList(new \stdClass());
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
        $track = '01234567890123';
        $this->instance->addTrack($track, $this->phone);

        $this->assertEquals(new Track($track, $this->phone), $this->instance->getTrack($track));
    }
}
