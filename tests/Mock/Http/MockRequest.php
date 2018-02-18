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
use NP\Model\Model;


/**
 * Class MockRequest
 * @package NP\Mock\Http
 */
class MockRequest extends Request
{

    /**
     * @var \stdClass
     */
    private $body;


    /**
     * Request constructor.
     */
    public function __construct()
    {
        $model = new Model();
        $model->setModelName('testModelName');
        $model->setCalledMethod('testCalledMethod');

        parent::__construct($model);

        $this->body = new \stdClass();
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
