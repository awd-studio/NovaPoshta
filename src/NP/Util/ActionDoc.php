<?php

/**
 * @file
 * This file is part of Test Projects PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/test-projects
 */

declare(strict_types=1); // strict mode


namespace NP\Util;

use ReflectionMethod;


/**
 * Class ActionDoc
 * @package NP\Util
 */
class ActionDoc
{
    use Helper;

    /**
     * Model class.
     *
     * @var ReflectionMethod
     */
    private $model;

    /**
     * DocBlock.
     *
     * @var string
     */
    private $docblock;


    /**
     * ActionDoc constructor.
     *
     * @param ReflectionMethod $model
     */
    public function __construct(ReflectionMethod $model)
    {
        $this->model = $model;
        $this->docblock = $this->getDocblock();
    }


    /**
     * Get method DocBlock.
     *
     * @return string
     */
    public function getDocblock(): string
    {
        return $this->model->getDocComment();
    }


    /**
     * Get annotations.
     *
     * @param string $tag
     * @param bool   $entity
     *
     * @return array
     */
    public function getAnnotation(string $tag = 'Action', bool $entity = true): array
    {
        return $this->parseAction($tag, $entity);
    }


    /**
     * Parse method DocBlock.
     *
     * @param string $tag
     * @param bool   $entity
     *
     * @return array
     */
    protected function parseAction(string $tag, bool $entity): array
    {
        $output = [];
        $pattern = $entity ? "\(([\s\w\d=\"\',*]+)\)" : "([\s\w\d]+(?:\r?\n))";
        preg_match_all("/(?:@{$tag}{$pattern})/u", $this->docblock, $matches);

        if ($matches[1]) {
            foreach ($matches[1] as $k => $match) {
                $item = [];
                $name = $k;
                foreach (preg_split("/(\r?\n\r?)/", $match) as $line) {
                    if ($line = ltrim(rtrim($line, '",; '), "* \t\n\r\0\x0B")) {
                        $data = explode(' = ', $line);
                        $item[$data[0]] = $value = trim($data[1], '\'"');
                        if ($data[0] == 'name') {
                            $name = $this->toActionCase($value);
                        }
                    }
                }
                $output[$name] = $item;
            }
        }

        return $output;
    }
}
