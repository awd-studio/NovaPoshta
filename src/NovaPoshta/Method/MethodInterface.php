<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/NovaPoshta
 */

declare(strict_types=1); // strict mode

namespace AwdStudio\NovaPoshta\Method;

use AwdStudio\NovaPoshta\Model\ModelInterface;

interface MethodInterface extends ModelInterface
{
    /**
     * Get the name of method.
     *
     * @return string
     */
    public function getCalledMethod(): string;
}
