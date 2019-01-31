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
 * Realize the Orders model.
 *
 * @link https://devcenter.novaposhta.ua/docs/services/556d7280a0fe4f08e8f7ce40/operations/574d90f4a0fe4f1150e501f4
 *
 * @package AwdStudio\NovaPoshta\Model
 */
abstract class Orders implements ModelInterface
{

    /**
     * Get the model name.
     *
     * @return string
     */
    public function getModelName(): string
    {
        return 'orders';
    }
}
