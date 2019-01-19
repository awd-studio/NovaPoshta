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

interface PrintDocumentInterface
{
    /**
     * Set order to orders.
     * Any type of document identification, either the REF, or the tracking number.
     *
     * @param string $order
     *
     * @return \AwdStudio\NovaPoshta\Method\Orders\PrintDocumentInterface
     */
    public function setOrder(string $order): self;

    /**
     * Set order orders.
     * A list og orders (either the REF, or the tracking number).
     *
     * @param array $orders
     *
     * @return \AwdStudio\NovaPoshta\Method\Orders\PrintDocumentInterface
     */
    public function setOrders(array $orders): self;

    /**
     * The type of response file.
     * Available format type ("pdf" or "html").
     *
     * @param string $type
     *
     * @return \AwdStudio\NovaPoshta\Method\Orders\PrintDocumentInterface
     */
    public function setType(string $type): self;
}