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


namespace NP\Mock;

use NP\Exception\ErrorException;


/**
 * Class Assets
 * @package Mock
 */
class Assets
{

    const ASSETS_JSON = 'json';

    /**
     * @var string
     */
    protected $assetsPath;


    /**
     * Assets constructor.
     */
    private function __construct()
    {
        $this->assetsPath = realpath(dirname(__FILE__) . "/../assets");
    }


    /**
     * Initialize assets builder.
     *
     * @return \NP\Mock\Assets
     */
    public static function init(): self
    {
        return new self();
    }


    /**
     * Get dir path
     *
     * @param string $dirName
     *
     * @return \NP\Mock\Assets
     */
    public function dir(string $dirName): self
    {
        $dir = "{$this->assetsPath}/{$dirName}";

        if (is_dir($dir)) {
            $this->assetsPath = $dir;
        }

        return $this;
    }


    /**
     * Get file.
     *
     * @param string $fileName
     *
     * @return string|bool The function returns the read data or false on failure.
     * @see \file_get_contents()
     * @throws \NP\Exception\ErrorException
     */
    public function file(string $fileName): string
    {
        $file = "{$this->assetsPath}/{$fileName}";

        if (is_readable($file)) {
            return file_get_contents($file);
        } else {
            throw new ErrorException("File \"{$file}\" not exists or not readable!");
        }
    }
}
