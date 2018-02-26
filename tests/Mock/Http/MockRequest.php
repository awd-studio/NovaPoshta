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

namespace NP\Mock\Http;

use NP\Http\Request;
use NP\Mock\Model\MockModelBuilder;


/**
 * Class MockRequest
 * @package NP\Mock\Http
 */
class MockRequest extends Request
{

    /**
     * @var bool
     */
    private $success;


    /**
     * Request constructor.
     * @param bool $success
     */
    public function __construct(bool $success = true)
    {
        $this->success = $success;
        $mb = new MockModelBuilder();

        parent::__construct($mb);
    }


    /**
     * Get API URI.
     *
     * @return string
     */
    public function getUri()
    {
        return $this->success ? parent::getUri() : 'mockFailedUri';
    }
}
