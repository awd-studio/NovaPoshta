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

namespace AwdStudio\NovaPoshta\Entity;

/**
 * Class DocumentNumber
 *
 * @package AwdStudio\NovaPoshta\Entity
 */
class DocumentNumber implements DocumentNumberInterface
{
    /** @var array */
    private $documents = [];

    /**
     * Set the property "DocumentNumber".
     *
     * @param string[36] $value The number of Tracking Document.
     *
     * @return \AwdStudio\NovaPoshta\Entity\DocumentNumberInterface
     */
    public function setDocumentNumber(string $value): DocumentNumberInterface
    {
        $this->documents['DocumentNumber'] = $value;

        return $this;
    }

    /**
     * Set the property "Phone".
     * Use to get additional info about the Tracking Document.
     *
     * @param string[36] $value (optional) The phone number of sender or receiver.
     *
     * @return \AwdStudio\NovaPoshta\Entity\DocumentNumberInterface
     */
    public function setPhone(?string $value = null): DocumentNumberInterface
    {
        $this->documents['Phone'] = $value;

        return $this;
    }

    /**
     * Get current document.
     *
     * @return array
     */
    public function getDocuments(): array
    {
        return $this->documents;
    }
}
