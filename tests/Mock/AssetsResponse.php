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


/**
 * Class AssetsResponse
 * @package Mock
 */
class AssetsResponse extends Assets
{

    /**
     * @param string $success
     *
     * @return string
     * @throws \NP\Exception\ErrorException
     */
    public static function json(string $success = 'success'): string
    {
        $fileName = $success === 'success' ? $success : 'failed';
        $assets = self::init();

        return $assets->dir('json')
            ->dir('response')
            ->file("{$fileName}.json");
    }
}
