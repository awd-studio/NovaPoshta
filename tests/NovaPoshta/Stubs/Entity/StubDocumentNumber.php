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

namespace AwdStudio\NovaPoshta\Test\Stubs\Entity;

use AwdStudio\NovaPoshta\Entity\DocumentNumberInterface;

/**
 * Mock Document Number
 *
 * @package AwdStudio\NovaPoshta\Mock\Entity
 */
class StubDocumentNumber implements DocumentNumberInterface
{
    const TRACK = '1234567891234';
    const PHONE = '+380000000000';

    /** @var array */
    private $document = [];

    /**
     * MockDocumentNumber constructor.
     */
    public function __construct()
    {
        $this->setDocumentNumber(self::TRACK);
        $this->setPhone(self::PHONE);
    }


    /**
     * Set the property "DocumentNumber".
     *
     * @param string[36] $value The name of city or ZIP-code
     *
     * @return \AwdStudio\NovaPoshta\Entity\DocumentNumberInterface
     */
    public function setDocumentNumber(string $value): DocumentNumberInterface
    {
        $this->document['DocumentNumber'] = $value;

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
        $this->document['Phone'] = $value;

        return $this;
    }

    /**
     * Get current document.
     *
     * @return array
     */
    public function getDocuments(): array
    {
        return $this->document;
    }
}
