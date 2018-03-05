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
 * Interface InternetDocumentInterface
 * @package  NP\Model
 *
 * @link     https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e
 */
interface InternetDocumentInterface
{


    /**
     * Method "save" - Create document.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/56260771a0fe4f1e503fe186
     *
     * @return Model
     */
    public function saveAction(array $options = []): Model;


    /**
     * Method "update" - Update document.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/55701ec2a0fe4f0cf4fc53eb
     *
     * @return Model
     */
    public function updateAction(array $options = []): Model;


    /**
     * Method "delete" - Delete document.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/55701fa5a0fe4f0cf4fc53ec
     *
     * @return Model
     */
    public function deleteAction(array $options = []): Model;


    /**
     * Method "getDocumentPrice" - Document calculation of cost.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/55702ee2a0fe4f0cf4fc53ef
     *
     * @return Model
     */
    public function getDocumentPriceAction(array $options = []): Model;


    /**
     * Method "getDocumentDeliveryDate" - Calculation of delivery date.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/558153cca0fe4f12149812a1
     *
     * @return Model
     */
    public function getDocumentDeliveryDateAction(array $options = []): Model;


    /**
     * Method "getDocumentList" - Get document list.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/557eb417a0fe4f02fc455b2c
     *
     * @return Model
     */
    public function getDocumentListAction(array $options = []): Model;


    /**
     * Method "generateReport" - Generate report about document list.
     *
     * @param array $options
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/55815af6a0fe4f12149812a2
     *
     * @return Model
     */
    public function generateReportAction(array $options = []): Model;
}
