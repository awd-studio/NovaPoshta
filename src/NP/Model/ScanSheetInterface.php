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
 * Interface ScanSheetInterface
 * @package  NP\Model
 *
 * @link     https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e
 */
interface ScanSheetInterface
{

    /**
     * Model "insertDocuments" - Add express documents.
     *
     * @param array $options
     *
     * @ActionParam(
     *     name = "DocumentRefs",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Document REFs"
     * )
     *
     * @ActionParam(
     *     name = "Ref",
     *     filters = "type=string|maxlen=36",
     *     description = "REF"
     * )
     *
     * @ActionParam(
     *     name = "Date",
     *     filters = "type=int|maxlen=36",
     *     description = "Date"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c4786a0fe4f0634657b65
     *
     * @return Model
     */
    public function insertDocumentsAction(array $options = []): Model;


    /**
     * Model "getScanSheet" - Get scan sheet.
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
     *     name = "CounterpartyRef",
     *     filters = "type=string|maxlen=36",
     *     description = "Counterparty REF"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c72d7a0fe4f08e8f7ce30
     *
     * @return Model
     */
    public function getScanSheetAction(array $options = []): Model;


    /**
     * Model "getScanSheetList" - Get scan sheet list.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c7734a0fe4f08e8f7ce31
     *
     * @return Model
     */
    public function getScanSheetListAction(array $options = []): Model;


    /**
     * Model "deleteScanSheet" - Delete (unformate) scan sheet.
     *
     * @param array $options
     *
     * @ActionParam(
     *     name = "ScanSheetRefs",
     *     required = true,
     *     filters = "type=string",
     *     description = "ScanSheet REFs"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c6a2da0fe4f08e8f7ce2f
     *
     * @return Model
     */
    public function deleteScanSheetAction(array $options = []): Model;


    /**
     * Model "removeDocuments" - Remove documents.
     *
     * @param array $options
     *
     * @ActionParam(
     *     name = "DocumentRefs",
     *     required = true,
     *     filters = "type=string",
     *     description = "Document REFs"
     * )
     *
     * @ActionParam(
     *     name = "Ref",
     *     filters = "type=string|maxlen=36",
     *     description = "REF"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e/operations/556c6474a0fe4f08e8f7ce2e
     *
     * @return Model
     */
    public function removeDocumentsAction(array $options = []): Model;
}
