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

namespace NP\Test\Mock\Http;

use NP\Http\Request;
use NP\NP;


/**
 * Class MockRequest
 * @package NP\Test\Mock\Http
 */
class MockRequest extends Request
{

    /**
     * @var \stdClass
     */
    private $body;


    /**
     * Request constructor.
     *
     * @param NP $np NovaPoshta instance.
     *
     * @return self
     */
    public function __construct(NP $np)
    {
        parent::__construct($np);

        $this->body = new \stdClass();

        return $this;
    }


    /**
     * Get API URI.
     *
     * @param bool $json
     *
     * @return string
     */
    public function getUri(bool $json = true): string
    {
        return '';
    }
}
