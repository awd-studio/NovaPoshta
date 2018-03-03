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

namespace NP\Model;

use NP\Entity\TrackList;
use NP\Exception\ErrorException;


/**
 * Class TrackingDocument.
 * Implements TrackingDocument model.
 *
 * @package NP\Model
 *
 * @link    https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/55702cbba0fe4f0cf4fc53ee
 */
class TrackingDocument extends Model implements TrackingDocumentsInterface
{

    /**
     * Set Documents to method properties.
     *
     * @param array $data
     * @throws ErrorException
     */
    public function setDocumentsToMethodProperties(array $data)
    {
        $this->setMethodProperty('Documents', (new TrackList($data))->getAllTracks());
    }


    /**
     * Method "getStatusDocuments" - Tracking documents status.
     *
     * @ActionParam(
     *     name = "Documents",
     *     required = true,
     *     callbackMethod = "setDocumentsToMethodProperties",
     *     description = "Documents mixed Available track-list"
     * )
     *
     * @see   \NP\TrackList::__construct
     * @link  https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/55702cbba0fe4f0cf4fc53ee
     *
     * @return Model
     */
    public function getStatusDocumentsAction(): Model
    {
        return $this;
    }
}
