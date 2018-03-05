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
 * Class AdditionalServiceGeneral
 * @package NP\Model
 *
 * @link    https://devcenter.novaposhta.ua/docs/services/58f722b3ff2c200c04673bd1
 */
class AdditionalServiceGeneral extends Model implements AdditionalServiceGeneralInterface
{

    /**
     * Method "save" - Save.
     *
     * @ActionParam(
     *     name = "OrderType",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "OrderType"
     * )
     *
     * @ActionParam(
     *     name = "IntDocNumber",
     *     required = true,
     *     filters = "type=int|maxlen=36",
     *     description = "Track number"
     * )
     *
     * @ActionParam(
     *     name = "Customer",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Redirection initiator"
     * )
     *
     * @ActionParam(
     *     name = "ServiceType",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Type of service (DoorsWarehouse or WarehouseWarehouse)"
     * )
     *
     * @ActionParam(
     *     name = "RecipientSettlement",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Recipient settlement ID"
     * )
     *
     * @ActionParam(
     *     name = "RecipientSettlementStreet",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Recipient settlement street ID"
     * )
     *
     * @ActionParam(
     *     name = "BuildingNumber",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "House number of building address"
     * )
     *
     * @ActionParam(
     *     name = "NoteAddressRecipient",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Note address recipient"
     * )
     *
     * @ActionParam(
     *     name = "RecipientWarehouse",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Recipient warehouse ID"
     * )
     *
     * @ActionParam(
     *     name = "Recipient",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Recipient ID"
     * )
     *
     * @ActionParam(
     *     name = "RecipientContactName",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Recipient contact name"
     * )
     *
     * @ActionParam(
     *     name = "RecipientPhone",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Recipient phone"
     * )
     *
     * @ActionParam(
     *     name = "PayerType",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Payer type"
     * )
     *
     * @ActionParam(
     *     name = "PaymentMethod",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Payment method"
     * )
     *
     * @ActionParam(
     *     name = "Note",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Redirection reason"
     * )
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/58f722b3ff2c200c04673bd1/operations/58f72344ff2c200c04673bd3
     *
     * @return Model
     */
    public function saveAction(array $options = []): Model
    {
        return $this;
    }


    /**
     * Method "delete" - Delete redirection.
     *
     * @ActionParam(
     *     name = "Ref",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Redirection REF ID"
     * )
     *
     * @ActionParam(
     *     name = "OrderType",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Order type"
     * )
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/58f722b3ff2c200c04673bd1/operations/58f7237bff2c200c04673bd4
     *
     * @return Model
     */
    public function deleteAction(array $options = []): Model
    {
        return $this;
    }


    /**
     * Method "checkPossibilityForRedirecting" - Check possibility for redirecting.
     *
     * @ActionParam(
     *     name = "Number",
     *     required = true,
     *     filters = "type=int|maxlen=36",
     *     description = "Number track"
     * )
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/58f722b3ff2c200c04673bd1/operations/58f7233eff2c200c04673bd2
     *
     * @return Model
     */
    public function checkPossibilityForRedirectingAction(array $options = []): Model
    {
        return $this;
    }


    /**
     * Method "getRedirectionOrdersList" - Get redirection orders-list.
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
     *
     * @param array $options
     *
     *
     * @link https://devcenter.novaposhta.ua/docs/services/58f722b3ff2c200c04673bd1/operations/58f72396ff2c200c04673bd5
     *
     * @return Model
     */
    public function getRedirectionOrdersListAction(array $options = []): Model
    {
        return $this;
    }
}
