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

namespace NP\Http;

use Exception;
use GuzzleHttp\Client;
use NP\Exception\ErrorException;


/**
 * Guzzle-client HTTP driver.
 * @package NP\Http
 */
class GuzzleDriver implements DriverInterface
{

    /**
     * Send HTTP request.
     *
     * @param Request $request
     *
     * @return string
     * @throws ErrorException
     */
    public function send(Request $request): string
    {
        try {
            $serverResponse = (new Client())->post($request->getUri(), [
                'json' => $request->getBody(),
            ]);

            return (string) $serverResponse->getBody();
        } catch (Exception $exception) {
            throw new ErrorException($exception->getMessage());
        }
    }
}
