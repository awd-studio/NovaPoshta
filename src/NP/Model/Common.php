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
 * Class Common
 * @package  NP\Model
 *
 * @link     https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed
 */
class Common extends Model implements CommonInterface
{

    /**
     * Method "getTimeIntervals" - Get time intervals.
     *
     * @param array $options
     *
     * @ActionParam(
     *     name = "RecipientCityRef",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Recipient city REF"
     * )
     *
     * @ActionParam(
     *     name = "DateTime",
     *     filters = "type=string|maxlen=36",
     *     description = "Date of intervals"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b6483890f
     *
     * @return Model
     */
    public function getTimeIntervalsAction(array $options = []): Model
    {
        return $this;
    }


    /**
     * Method "getCargoTypes" - Get cargo types.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838909
     *
     * @return Model
     */
    public function getCargoTypesAction(array $options = []): Model
    {
        return $this;
    }


    /**
     * Method "getBackwardDeliveryCargoTypes" - Get backward delivery cargo types.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838907
     *
     * @return Model
     */
    public function getBackwardDeliveryCargoTypesAction(array $options = []): Model
    {
        return $this;
    }


    /**
     * Method "getPalletsList" - Get pallets list.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/5824774ba0fe4f0e60694eb0
     *
     * @return Model
     */
    public function getPalletsListAction(array $options = []): Model
    {
        return $this;
    }


    /**
     * Method "getTypesOfPayers" - Get types of payers.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838913
     *
     * @return Model
     */
    public function getTypesOfPayersAction(array $options = []): Model
    {
        return $this;
    }


    /**
     * Method "getTypesOfPayersForRedelivery" - Get types of payers for redelivery.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838914
     *
     * @return Model
     */
    public function getTypesOfPayersForRedeliveryAction(array $options = []): Model
    {
        return $this;
    }


    /**
     * Method "getPackList" - Get pack list.
     *
     * @param array $options
     *
     * @ActionParam(
     *     name = "Length",
     *     filters = "type=string",
     *     description = "Length"
     * )
     *
     * @ActionParam(
     *     name = "Width",
     *     filters = "type=string",
     *     description = "Width"
     * )
     *
     * @ActionParam(
     *     name = "Height",
     *     filters = "type=string",
     *     description = "Height"
     * )
     *
     * @ActionParam(
     *     name = "TypeOfPacking",
     *     filters = "type=string",
     *     description = "Type of packing"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/582b1069a0fe4f0298618f06
     *
     * @return Model
     */
    public function getPackListAction(array $options = []): Model
    {
        return $this;
    }


    /**
     * Method "getTiresWheelsList" - Get tires wheels list.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838910
     *
     * @return Model
     */
    public function getTiresWheelsListAction(array $options = []): Model
    {
        return $this;
    }


    /**
     * Method "getCargoDescriptionList" - Get cargo description list.
     *
     * @param array $options
     *
     * @ActionParam(
     *     name = "FindByString",
     *     filters = "type=string",
     *     description = "Find city by string"
     * )
     *
     * @ActionParam(
     *     name = "Page",
     *     filters = "type=int",
     *     description = "Page number"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838908
     *
     * @return Model
     */
    public function getCargoDescriptionListAction(array $options = []): Model
    {
        return $this;
    }


    /**
     * Method "getMessageCodeText" - Get message code text.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/58f0730deea270153c8be3cd
     *
     * @return Model
     */
    public function getMessageCodeTextAction(array $options = []): Model
    {
        return $this;
    }


    /**
     * Method "getServiceTypes" - Get service types.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b6483890e
     *
     * @return Model
     */
    public function getServiceTypesAction(array $options = []): Model
    {
        return $this;
    }


    /**
     * Method "getTypesOfCounterparties" - Get types of counterparties.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b64838912
     *
     * @return Model
     */
    public function getTypesOfCounterpartiesAction(array $options = []): Model
    {
        return $this;
    }


    /**
     * Method "getPaymentForms" - Get payment forms.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b6483890d
     *
     * @return Model
     */
    public function getPaymentFormsAction(array $options = []): Model
    {
        return $this;
    }


    /**
     * Method "getOwnershipFormsList" - Get ownership forms list.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/55702571a0fe4f0b6483890b
     *
     * @return Model
     */
    public function getOwnershipFormsListAction(array $options = []): Model
    {
        return $this;
    }
}
