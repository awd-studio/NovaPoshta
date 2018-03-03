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


namespace NP\Common\Util;

use ReflectionMethod;


/**
 * Class ActionDoc
 * @package NP\Common\Util
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
    private $docBlock;


    /**
     * ActionDoc constructor.
     *
     * @param ReflectionMethod $model
     */
    public function __construct(ReflectionMethod $model)
    {
        $this->model = $model;
        $this->docBlock = $this->getDocBlock();
    }


    /**
     * Get method DocBlock.
     *
     * @return string
     */
    public function getDocBlock(): string
    {
        return $this->model->getDocComment();
    }


    /**
     * Get annotations.
     *
     * @param string $tag
     *
     * @return array
     */
    public function getAnnotation(string $tag = 'ActionParam'): array
    {
        return $this->parseAction($tag);
    }


    /**
     * Parse method DocBlock.
     *
     * @param string $tag
     *
     * @return array
     *
     * ToDo: Replace with try/catch blocks, for catching ActionBlocs parsed with errors;
     */
    protected function parseAction(string $tag): array
    {
        $output = [];
        $pattern = "/(?:@{$tag}\((?P<{$tag}>[\s\w\-*=\",|\/`'^*_+@!$%?]+)\))/u";
        preg_match_all($pattern, $this->docBlock, $matches, PREG_PATTERN_ORDER);

        if ($matchesBlocks = $matches[$tag]) {
            foreach ($matchesBlocks as $k => $match) {
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
