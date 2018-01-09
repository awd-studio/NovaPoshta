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
     */
    public function setDocumentsToMethodProperties()
    {
        $this->setMethodProperties([
            'Documents' => (new TrackList($this->getMethodProperties()))->getAllTracks(),
        ]);
    }


    /**
     * Method "getStatusDocuments" - Tracking documents status.
     *
     * Options: Documents mixed Available track-list.
     *
     * @Method getStatusDocuments
     *
     * @Action(
     *     modelName = "TrackingDocument",
     *     calledMethod = "getStatusDocuments"
     * )
     *
     * @ActionParam(
     *     name = "Documents",
     *     required = true,
     *     callbackMethod = setDocumentsToMethodProperties
     * )
     *
     * @see    \NP\TrackList::__construct
     * @link   https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/55702cbba0fe4f0cf4fc53ee
     *
     * @return \NP\Model\Model
     */
    public function getStatusDocumentsAction(): Model
    {
        /*$this->getRequiredProperties([
            'Documents',
        ]);*/

        return $this;
    }
}
