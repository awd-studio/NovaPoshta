<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author   Anton Karpov <awd.com.ua@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     https://github.com/awd-studio/novaposhta
 */

namespace NP\Http;


/**
 * Driver Interface.
 * @package NP\Http
 */
interface DriverInterface
{

    /**
     * Send HTTP request.
     *
     * @param Request $request
     * @return Response
     */
    public function send(Request $request);
}
