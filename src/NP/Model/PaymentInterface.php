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


namespace NP\Model;


/**
 * Interface PaymentInterface
 * @package  NP\Model
 *
 * @link     https://devcenter.novaposhta.ua/docs/services/59a42363ff2c201434937b23
 */
interface PaymentInterface
{

    /**
     * Method "getCards" - Get cards.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/59a42363ff2c201434937b23/operations/59a42830eea27010d84d6651
     *
     * @return Model
     */
    public function getCardsAction(array $options = []): Model;
}
