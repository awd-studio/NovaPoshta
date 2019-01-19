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

interface DocumentNumberInterface
{
    /**
     * Set the property "DocumentNumber".
     *
     * @param string[36] $value The name of city or ZIP-code
     *
     * @return \AwdStudio\NovaPoshta\Entity\DocumentNumberInterface
     */
    public function setDocumentNumber(string $value): self;

    /**
     * Set the property "Phone".
     * Use to get additional info about the Tracking Document.
     *
     * @param string[36] $value (optional) The phone number of sender or receiver.
     *
     * @return \AwdStudio\NovaPoshta\Entity\DocumentNumberInterface
     */
    public function setPhone(?string $value = null): self;

    /**
     * Get current document.
     *
     * @return array
     */
    public function getDocuments(): array;
}
