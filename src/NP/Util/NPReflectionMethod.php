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


namespace NP\Util;

use ReflectionMethod;


/**
 * Class NPReflectionMethod
 * @package NP\Util
 */
class NPReflectionMethod extends ReflectionMethod
{
    /**
     * Return invoked method.
     *
     * @param mixed  $class Class-name or object (instance of the class) that contains the method.
     * @param string $name  Name of the method, or the method FQN in the form 'Foo::bar' if $class argument missing
     * @param array  $data  Zero or more parameters to be passed to the method.
     *                      It accepts a variable number of parameters which are passed to the method.
     *
     * @return mixed the method result.
     */
    public static function build($class, string $name, array $data = [])
    {
        return (new self($class, $name))->invoke(...$data);
    }
}
