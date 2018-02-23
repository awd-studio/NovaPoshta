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

namespace NP\Exception;

use Throwable;


/**
 * Class ErrorException
 * @package NP\Exception
 */
class ErrorException extends \Exception implements NPException
{

    /**
     * @var Error
     */
    private $error;


    /**
     * ErrorException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        $this->error = new Error($message, $code);

        parent::__construct($message, $code, $previous);
    }


    /**
     * Get JSON-encoded Error.
     *
     * @return string
     */
    public function toJson(): string
    {
        return $this->error->toJson();
    }
}
