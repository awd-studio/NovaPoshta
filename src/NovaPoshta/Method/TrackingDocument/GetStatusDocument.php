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

namespace AwdStudio\NovaPoshta\Method\TrackingDocument;

use AwdStudio\NovaPoshta\Entity\DocumentNumberInterface;
use AwdStudio\NovaPoshta\Method\MethodPostInterface;
use AwdStudio\NovaPoshta\Model\TrackingDocument;

/**
 * Implements the "getStatusDocuments" method of model "TrackingDocument"
 *
 * @link https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/55702cbba0fe4f0cf4fc53ee
 *
 * @package AwdStudio\NovaPoshta\Method\TrackingDocument
 */
class GetStatusDocument extends TrackingDocument implements GetStatusDocumentsInterface, MethodPostInterface
{
    /** @var array */
    private $properties;

    /**
     * Get HTTP method.
     *
     * @return string
     */
    public function getHttpMethod(): string
    {
        return 'POST';
    }

    /**
     * Get the name of method.
     *
     * @return string
     */
    public function getCalledMethod(): string
    {
        return 'getStatusDocuments';
    }

    /**
     * Get the method properties array.
     *
     * @return array|null
     */
    public function getMethodProperties(): ?array
    {
        return $this->properties;
    }

    /**
     * Set the property "Documents" of the "TrackingDocument" model.
     *
     * @param array<DocumentNumberInterface> $value List of Tracking Documents
     *
     * @return \AwdStudio\NovaPoshta\Method\TrackingDocument\GetStatusDocumentsInterface
     */
    public function setDocuments(array $value): GetStatusDocumentsInterface
    {
        $this->properties['Documents'] = $value;

        return $this;
    }
}
