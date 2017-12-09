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

use GuzzleHttp\Client;


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
     * @return Response
     */
    public function send(Request $request)
    {
        try {
            $client = new Client();

            $serverResponse = $client->post($request->getUri(), [
                'json' => $request->getBody(),
            ]);

            $response = (string) $serverResponse->getBody();
        } catch (\Exception $exception) {
            $response = json_encode([
                'code'  => 0,
                'error' => $exception->getMessage(),
            ]);
        } finally {
            return new Response($response);
        }
    }
}
