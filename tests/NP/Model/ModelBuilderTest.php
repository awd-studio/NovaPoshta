<?php

/**
 * @file
 * This file is part of NovaPoshta PHP library.
 *
 * @author  Anton Karpov <awd.com.ua@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 * @link    https://github.com/awd-studio/novaposhta
 */

namespace NP\Test\Model;

use NP\Common\Config;
use NP\Model\Model;
use NP\Model\ModelBuilder;
use PHPUnit\Framework\TestCase;

/**
 * Class ModelBuilderTest
 * @package NP\Test\Model
 */
class ModelBuilderTest extends TestCase
{

    /**
     * @covers \NP\Model\ModelBuilder::build
     */
    public function testBuild()
    {
        $this->assertNull(ModelBuilder::build(new Config(), '', ''));
        $this->assertInstanceOf(Model::class, ModelBuilder::build(new Config(),'TrackingDocument', 'getStatusDocuments'));
    }
}
