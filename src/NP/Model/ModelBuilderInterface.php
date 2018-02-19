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


namespace NP\Model;


/**
 * ModelBuilder Interface
 * @package NP\Model
 */
interface ModelBuilderInterface
{

    /**
     * Get serialized object.
     *
     * @return object
     */
    public function getBody();
}
