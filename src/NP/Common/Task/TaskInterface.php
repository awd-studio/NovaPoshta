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


namespace NP\Common\Task;

use NP\Http\Request;
use NP\Http\ResponseInterface;


/**
 * Task Interface
 * @package NP\Common\Task
 */
interface TaskInterface
{

    /**
     * Get task request.
     *
     * @return Request
     */
    public function getRequest(): Request;


    /**
     * Execute task request.
     */
    public function execute();


    /**
     * Get task response.
     *
     * @return ResponseInterface|null
     */
    public function getResponse();
}
