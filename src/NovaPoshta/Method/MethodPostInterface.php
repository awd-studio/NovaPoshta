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

namespace AwdStudio\NovaPoshta\Method;

interface MethodPostInterface extends MethodInterface
{
    /**
     * Get the method properties array.
     *
     * @return array|null
     */
    public function getMethodProperties(): ?array;
}