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
use AwdStudio\NovaPoshta\Method\MethodInterface;

interface GetStatusDocumentsInterface extends MethodInterface
{
    /**
     * Set the property "Documents" of the "TrackingDocument" model.
     *
     * @param array<DocumentNumberInterface> $value List of Tracking Documents
     *
     * @return \AwdStudio\NovaPoshta\Method\TrackingDocument\GetStatusDocumentsInterface
     */
    public function setDocuments(array $value): self;
}
