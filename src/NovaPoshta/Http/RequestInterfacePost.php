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

interface RequestInterfacePost extends RequestInterface
{
    /**
     * Set requested body data.
     *
     * @param string $body
     *
     * @return \AwdStudio\NovaPoshta\Http\RequestInterfacePost
     */
    public function setBody(string $body): self;
}
