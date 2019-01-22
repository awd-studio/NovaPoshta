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

use AwdStudio\NovaPoshta\Method\MethodPostInterface;
use AwdStudio\NovaPoshta\Model\Address;

/**
 * Implements the "searchSettlements" method of model "Address"
 *
 * @link https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/58e5ebeceea27017bc851d67
 *
 * @package AwdStudio\NovaPoshta\Method\Address
 */
class SearchSettlements extends Address implements SearchSettlementsInterface, MethodPostInterface
{
    /** @var array */
    private $properties = [];

    /**
     * Get the name of method.
     *
     * @return string
     */
    public function getCalledMethod(): string
    {
        return 'searchSettlements';
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
     * Set the property "CityName" of the "Address" model.
     *
     * @param string[36] $value The name of city or ZIP-code
     *
     * @return \AwdStudio\NovaPoshta\Method\Address\SearchSettlementsInterface
     */
    public function setCityName(string $value): SearchSettlementsInterface
    {
        $this->properties['CityName'] = $value;

        return $this;
    }

    /**
     * Set the property "Limit" of the "Address" model.
     *
     * @param int[36] $value
     *
     * @return \AwdStudio\NovaPoshta\Method\Address\SearchSettlementsInterface
     */
    public function setLimit(int $value): SearchSettlementsInterface
    {
        $this->properties['Limit'] = $value;

        return $this;
    }
}
