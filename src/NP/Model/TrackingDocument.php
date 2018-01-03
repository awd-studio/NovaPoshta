<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link   https://github.com/awd-studio/novaposhta
 */

declare(strict_types=1); // strict mode

namespace NP\Model;

use NP\Entity\TrackList;


/**
 * Class TrackingDocument.
 * Implements TrackingDocument model.
 *
 * @package NP\Model
 *
 * @link   https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/55702cbba0fe4f0cf4fc53ee
 */
class TrackingDocument extends Model implements TrackingDocumentsInterface
{

    /**
     * Valid tracking number.
     *
     * @see \NP\Entity\TrackList::__construct
     *
     * @var TrackList
     */
    protected $trackList;


    /**
     * Set track-list.
     *
     * @param mixed $trackList
     *
     * @see \NP\Entity\TrackList::__construct()
     */
    public function setTrackList($trackList)
    {
        $this->trackList = $trackList;
    }


    /**
     * Get track-list.
     *
     * @return TrackList
     */
    public function getTrackList(): TrackList
    {
        return $this->trackList;
    }


    /**
     * Method "getStatusDocuments" - Tracking documents status.
     *
     * Options: Documents mixed Available track-list.
     *
     * @see  \NP\TrackList::__construct
     * @link https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/55702cbba0fe4f0cf4fc53ee
     *
     * @return \NP\Model\Model
     * @throws \NP\Exception\ErrorException
     */
    public function getStatusDocumentsAction(): Model
    {
        $this->setMethodProperties([
            'Documents' => (new TrackList($this->getMethodProperties()))->getAllTracks(),
        ]);

        $this->getRequiredProperties([
            'Documents',
        ]);

        return $this;
    }
}
