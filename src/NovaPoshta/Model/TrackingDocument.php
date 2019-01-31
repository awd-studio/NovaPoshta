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
 * @link https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/55702cbba0fe4f0cf4fc53ee
 * @package AwdStudio\NovaPoshta\Model\TrackingDocument
 */
abstract class TrackingDocument implements ModelInterface
{

    /**
     * Get the model name.
     *
     * @return string
     */
    public function getModelName(): string
    {
        return 'TrackingDocument';
    }
}
