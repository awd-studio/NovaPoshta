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
 * Interface CounterpartyInterface
 * @package  NP\Model
 *
 * @link     https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d
 */
interface CounterpartyInterface
{

    /**
     * Method "save" - Save counterpart.
     *
     * @param array $options
     *
     * @ActionParam(
     *     name = "CityRef",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "City REF"
     * )
     *
     * @ActionParam(
     *     name = "FirstName",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "First name"
     * )
     *
     * @ActionParam(
     *     name = "LastName",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Last name"
     * )
     *
     * @ActionParam(
     *     name = "MiddleName",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Middle name"
     * )
     *
     * @ActionParam(
     *     name = "Phone",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Phone"
     * )
     *
     * @ActionParam(
     *     name = "Email",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Email"
     * )
     *
     * @ActionParam(
     *     name = "CounterpartyType",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Counterparty type"
     * )
     *
     * @ActionParam(
     *     name = "CounterpartyProperty",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Counterparty property"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/557ebbd3a0fe4f02fc455b2e
     *
     * @return Model
     */
    public function saveAction(array $options = []): Model;


    /**
     * Method "update" - Update counterpart.
     *
     * @param array $options
     *
     * @ActionParam(
     *     name = "CityRef",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "City REF"
     * )
     *
     * @ActionParam(
     *     name = "FirstName",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "First name"
     * )
     *
     * @ActionParam(
     *     name = "LastName",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Last name"
     * )
     *
     * @ActionParam(
     *     name = "MiddleName",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Middle name"
     * )
     *
     * @ActionParam(
     *     name = "Phone",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Phone"
     * )
     *
     * @ActionParam(
     *     name = "Email",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Email"
     * )
     *
     * @ActionParam(
     *     name = "CounterpartyType",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Counterparty type"
     * )
     *
     * @ActionParam(
     *     name = "CounterpartyProperty",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Counterparty property"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/557ebbd3a0fe4f02fc455b2e
     *
     * @return Model
     */
    public function updateAction(array $options = []): Model;


    /**
     * Method "delete" - Delete counterpart.
     *
     * @param array $options
     *
     * @ActionParam(
     *     name = "Ref",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "REF"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/557fd35da0fe4f105c08760e
     *
     * @return Model
     */
    public function deleteAction(array $options = []): Model;


    /**
     * Method "getCounterpartyAddresses" - Get counterpart list.
     *
     * @param array $options
     *
     * @ActionParam(
     *     name = "Ref",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "REF"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/557fdcb4a0fe4f105c087611
     *
     * @return Model
     */
    public function getCounterpartyAddressesAction(array $options = []): Model;


    /**
     * Method "getCounterpartyOptions" - Get counterparty options.
     *
     * @param array $options
     *
     * @ActionParam(
     *     name = "Ref",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "REF"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/55801976a0fe4f105c087614
     *
     * @return Model
     */
    public function getCounterpartyOptionsAction(array $options = []): Model;


    /**
     * Method "getCounterpartyContactPerson" - Get counterparty contact persons.
     *
     * @param array $options
     *
     * @ActionParam(
     *     name = "Ref",
     *     filters = "type=string|maxlen=36",
     *     description = "REF"
     * )
     *
     * @ActionParam(
     *     name = "Page",
     *     filters = "type=string|maxlen=36",
     *     description = "Page"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/557fe424a0fe4f105c087612
     *
     * @return Model
     */
    public function getCounterpartyContactPersonAction(array $options = []): Model;


    /**
     * Method "getCounterparties" - Get counterparties.
     *
     * @param array $options
     *
     * @ActionParam(
     *     name = "CounterpartyProperty",
     *     filters = "type=string|maxlen=36",
     *     description = "Counterparty property (Sender, Recipient or ThirdPerson)"
     * )
     *
     * @ActionParam(
     *     name = "Page",
     *     filters = "type=string|maxlen=36",
     *     description = "Page"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/557fd789a0fe4f105c08760f
     *
     * @return Model
     */
    public function getCounterpartiesAction(array $options = []): Model;
}
