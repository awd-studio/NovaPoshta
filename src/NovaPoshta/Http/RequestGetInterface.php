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

namespace AwdStudio\NovaPoshta\Http;

interface RequestGetInterface
{
    /**
     * Set up request with headers.
     *
     * @param array|null $headers
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestGetInterface
     */
    public function setHeaders(?array $headers = null): self;

    /**
     * Set the URL address.
     *
     * @param string $url
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestGetInterface
     */
    public function setUrl(string $url): self;

    /**
     * Execute the request.
     *
     * @return string
     * @throws \AwdStudio\NovaPoshta\Exception\RequestException
     */
    public function execute(): string;
}
