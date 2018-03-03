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

namespace NP\Mock\Model;

use NP\Model\Model;


/**
 * Class MockModel.
 * @package NP\Model
 */
class MockModel extends Model
{


    /**
     * Method "mockModelMethod" - Tracking documents statusOnly for testing.
     *
     * @ActionParam(
     *     name = "MockRequiredParam",
     *     required = true,
     *     description = "Mock parameter for testing"
     * )
     *
     * @ActionParam(
     *     name = "MockParam",
     *     description = "Mock parameter for testing"
     * )
     *
     * @return Model
     */
    function mockModelMethodAction(): Model
    {
        return $this;
    }
}
