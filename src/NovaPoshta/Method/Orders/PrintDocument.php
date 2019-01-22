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

namespace AwdStudio\NovaPoshta\Method\Orders;

use AwdStudio\NovaPoshta\Method\MethodGetInterface;
use AwdStudio\NovaPoshta\Model\Orders;

/**
 * Implements the "printDocument" method of model "Orders".
 *
 * @link https://devcenter.novaposhta.ua/docs/services/556d7280a0fe4f08e8f7ce40/operations/574d90f4a0fe4f1150e501f4
 *
 * @package AwdStudio\NovaPoshta\Method\Orders
 */
class PrintDocument extends Orders implements MethodGetInterface, PrintDocumentInterface
{
    /** @var array */
    private $queryParameters;

    /**
     * PrintDocument constructor.
     */
    public function __construct()
    {
        // Set up the default type
        $this->setType('pdf');
    }

    /**
     * Get query parameters to use for request building.
     *
     * @return array
     */
    public function getQueryParameters(): array
    {
        return $this->queryParameters;
    }

    /**
     * Get the name of method.
     *
     * @return string
     */
    public function getCalledMethod(): string
    {
        return 'printDocument';
    }

    /**
     * Set order to orders.
     * Any type of document identification, either the REF, or the tracking number.
     *
     * @param string $order
     *
     * @return \AwdStudio\NovaPoshta\Method\Orders\PrintDocumentInterface
     */
    public function setOrder(string $order): PrintDocumentInterface
    {
        $this->queryParameters['orders'][] = $order;

        return $this;
    }

    /**
     * Set order orders.
     * A list og orders (either the REF, or the tracking number).
     *
     * @param array $orders
     *
     * @return \AwdStudio\NovaPoshta\Method\Orders\PrintDocumentInterface
     */
    public function setOrders(array $orders): PrintDocumentInterface
    {
        $this->queryParameters['orders'] = $orders;

        return $this;
    }

    /**
     * The type of response file.
     * Available format type ("pdf" or "html").
     *
     * @param string $type
     *
     * @return \AwdStudio\NovaPoshta\Method\Orders\PrintDocumentInterface
     */
    public function setType(string $type): PrintDocumentInterface
    {
        $this->queryParameters['type'] = $type;

        return $this;
    }
}
