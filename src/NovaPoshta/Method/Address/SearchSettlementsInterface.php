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

namespace AwdStudio\NovaPoshta\Method\Address;

use AwdStudio\NovaPoshta\Method\MethodInterface;

interface SearchSettlementsInterface extends MethodInterface
{
    /**
     * Set the property "CityName" of the "Address" model.
     *
     * @param string[36] $value The name of city or ZIP-code
     *
     * @return \AwdStudio\NovaPoshta\Method\Address\SearchSettlementsInterface
     */
    public function setCityName(string $value): self;

    /**
     * Set the property "Limit" of the "Address" model.
     *
     * @param int[36] $value The count of answers.
     *
     * @return \AwdStudio\NovaPoshta\Method\Address\SearchSettlementsInterface
     */
    public function setLimit(int $value): self;
}
