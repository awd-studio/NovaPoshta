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
 * Interface ContactPersonInterface
 * @package  NP\Model
 *
 * @link     https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/55828c4ca0fe4f0adc08ef27
 */
interface ContactPersonInterface
{

    /**
     * Method "save" - Save contact person.
     *
     * @param array $options
     *
     * @ActionParam(
     *     name = "CounterpartyRef",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Counterparty REF"
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
     * @link https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/55828c4ca0fe4f0adc08ef27
     *
     * @return Model
     */
    public function saveAction(array $options = []): Model;


    /**
     * Method "update" - Update contact person.
     *
     * @param array $options
     *
     * @ActionParam(
     *     name = "CounterpartyRef",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Counterparty REF"
     * )
     *
     * @ActionParam(
     *     name = "Ref",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "REF"
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
     * @link https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/558297aca0fe4f0adc08ef28
     *
     * @return Model
     */
    public function updateAction(array $options = []): Model;


    /**
     * Method "delete" - Delete contact person.
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
     * @link https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/55829aa2a0fe4f0adc08ef29
     *
     * @return Model
     */
    public function deleteAction(array $options = []): Model;
}
