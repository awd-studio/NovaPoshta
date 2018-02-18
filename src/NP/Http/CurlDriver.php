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

use NP\Exception\ErrorException;
use NP\Exception\Errors;


/**
 * Class CurlDriver
 * @package NP\Http
 */
class CurlDriver implements DriverInterface
{

    /**
     * Send HTTP request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function send(Request $request): Response
    {
        $errors = Errors::getInstance();

        try {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL            => $request->getUri(),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => "POST",
                CURLOPT_POSTFIELDS     => $request->getBodyJson(),
                CURLOPT_HTTPHEADER     => ["content-type: application/json"],
            ]);

            $response = curl_exec($curl);

            curl_close($curl);

            if ($err = curl_error($curl)) {
                throw new ErrorException("cURL Error #:" . $err);
            }
        } catch (ErrorException $exception) {
            $response = $errors->addError($exception->getMessage())->toJson();
        } finally {
            return new Response($response);
        }
    }
}
