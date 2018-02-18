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
use NP\Http\Response;


/**
 * Task Interface
 * @package NP\Common\Task
 */
interface TaskInterface
{

    /**
     * Get task ID.
     *
     * @return int
     */
    public function getId(): int;


    /**
     * Get task request.
     *
     * @return Request
     */
    public function getRequest(): Request;


    /**
     * Get task response.
     *
     * @return Response|null
     */
    public function getResponse();


    /**
     * Execute task request.
     *
     * @return Response
     */
    public function execute(): Response;
}
