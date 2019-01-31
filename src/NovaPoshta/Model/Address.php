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

namespace AwdStudio\NovaPoshta\Model;

/**
 * Realize the Address model.
 *
 * @link https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/58e5ebeceea27017bc851d67
 * @package AwdStudio\NovaPoshta\Model\Address
 */
abstract class Address implements ModelInterface
{
    /**
     * Get the model name.
     *
     * @return string
     */
    public function getModelName(): string
    {
        return 'Address';
    }
}
