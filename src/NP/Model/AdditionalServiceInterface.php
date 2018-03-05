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
 * Interface AdditionalServiceInterface
 * @package  NP\Model
 *
 * @link     https://devcenter.novaposhta.ua/docs/services/58ad7185eea27006cc36d649
 */
interface AdditionalServiceInterface
{

    /**
     * Method "save" - Save additional service.
     *
     * @ActionParam(
     *     name = "IntDocNumber",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "IntDocNumber"
     * )
     *
     * @ActionParam(
     *     name = "PaymentMethod",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "PaymentMethod"
     * )
     *
     * @ActionParam(
     *     name = "Reason",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Reason"
     * )
     *
     * @ActionParam(
     *     name = "SubtypeReason",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "SubtypeReason"
     * )
     *
     * @ActionParam(
     *     name = "Note",
     *     filters = "type=string|maxlen=100",
     *     description = "Note"
     * )
     *
     * @ActionParam(
     *     name = "OrderType",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "OrderType"
     * )
     *
     * @ActionParam(
     *     name = "ReturnAddressRef",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "ReturnAddressRef"
     * )
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/58ad7185eea27006cc36d649/operations/58b6d227ff2c200cd80adb94
     *
     * @return Model
     */
    public function saveAction(array $options = []): Model;


    /**
     * Method "delete" - Delete additional service.
     *
     * @ActionParam(
     *     name = "Ref",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Ref"
     * )
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/58ad7185eea27006cc36d649/operations/58b6cdf4ff2c200cd80adb93
     *
     * @return Model
     */
    public function deleteAction(array $options = []): Model;


    /**
     * Method "checkPossibilityCreateReturn" - Check possibility create return.
     *
     * @ActionParam(
     *     name = "Number",
     *     required = true,
     *     filters = "type=int|maxlen=36",
     *     description = "Number"
     * )
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/58ad7185eea27006cc36d649/operations/58b6b830ff2c200cd80adb91
     *
     * @return Model
     */
    public function checkPossibilityCreateReturnAction(array $options = []): Model;


    /**
     * Method "getReturnReasons" - Get return reasons.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/58ad7185eea27006cc36d649/operations/58b6cd6aeea2700d141ccae1
     *
     * @return Model
     */
    public function getReturnReasonsAction(array $options = []): Model;


    /**
     * Method "getReturnReasonsSubtypes" - Get return reasons subtypes.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/58ad7185eea27006cc36d649/operations/58b6cdb2ff2c200cd80adb92
     *
     * @return Model
     */
    public function getReturnReasonsSubtypesAction(array $options = []): Model;


    /**
     * Method "getReturnOrdersList" - Get return orders list.
     *
     * @ActionParam(
     *     name = "Number",
     *     filters = "type=int|maxlen=36",
     *     description = "Number"
     * )
     *
     * @ActionParam(
     *     name = "Ref",
     *     filters = "type=string|maxlen=36",
     *     description = "Ref"
     * )
     *
     * @ActionParam(
     *     name = "BeginDate",
     *     filters = "type=int|maxlen=36",
     *     description = "BeginDate"
     * )
     *
     * @ActionParam(
     *     name = "EndDate",
     *     filters = "type=int|maxlen=36",
     *     description = "EndDate"
     * )
     *
     * @ActionParam(
     *     name = "Page",
     *     filters = "type=string|maxlen=36",
     *     description = "Page"
     * )
     *
     * @ActionParam(
     *     name = "Limit",
     *     filters = "type=string|maxlen=36",
     *     description = "Limit"
     * )
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/58ad7185eea27006cc36d649/operations/58b6cdc9eea2700d141ccae2
     *
     * @return Model
     */
    public function getReturnOrdersListAction(array $options = []): Model;
}
