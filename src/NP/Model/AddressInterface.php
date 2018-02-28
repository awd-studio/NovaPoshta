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
 * Interface AddressInterface
 * @package  NP\Model
 *
 * @link     https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43
 */
interface AddressInterface
{

    /**
     * Method "save" - Create counterpart.
     *
     * @ActionParam(
     *     name = "CounterpartyRef",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Counterparty REF"
     * )
     *
     * @ActionParam(
     *     name = "StreetRef",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Street REF"
     * )
     *
     * @ActionParam(
     *     name = "BuildingNumber",
     *     required = true,
     *     filters = "type=string",
     *     description = "Building number"
     * )
     *
     * @ActionParam(
     *     name = "Flat",
     *     required = true,
     *     filters = "type=string",
     *     description = "Flat"
     * )
     *
     * @ActionParam(
     *     name = "Note",
     *     filters = "type=string|maxlen=40",
     *     description = "Note comment"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d9925a0fe4f08e8f7ce4a
     *
     * @return Model
     *
     * ToDo: Implement the method
     * ToDo: Check method correct name ("save" or "Save")
     */
    //public function save(array $options = []);


    /**
     * Method "update" - Update counterpart address.
     *
     * @ActionParam(
     *     name = "Ref",
     *     filters = "type=string|maxlen=36",
     *     description = "Address REF"
     * )
     *
     * @ActionParam(
     *     name = "CounterpartyRef",
     *     filters = "type=string|maxlen=36",
     *     description = "Counterparty REF"
     * )
     *
     * @ActionParam(
     *     name = "StreetRef",
     *     filters = "type=string|maxlen=36",
     *     description = "Street REF"
     * )
     *
     * @ActionParam(
     *     name = "BuildingNumber",
     *     filters = "type=string",
     *     description = "Building number"
     * )
     *
     * @ActionParam(
     *     name = "Flat",
     *     filters = "type=string",
     *     description = "Flat"
     * )
     *
     * @ActionParam(
     *     name = "Note",
     *     filters = "type=string|maxlen=40",
     *     description = "Note comment"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d9db5a0fe4f08e8f7ce4b
     *
     * @return Model
     *
     * ToDo: Implement the method
     */
    //public function update(array $options = []);


    /**
     * Method "delete" - Delete counterpart address.
     *
     * @ActionParam(
     *     name = "Ref",
     *     filters = "type=string|maxlen=36",
     *     description = "Address REF"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556da062a0fe4f08e8f7ce4c
     *
     * @return Model
     *
     * ToDo: Implement the method
     */
    //public function delete(array $options = []);


    /**
     * Method "getCities" - Get cities.
     *
     * @ActionParam(
     *     name = "Ref",
     *     filters = "type=string|maxlen=36",
     *     description = "City REF"
     * )
     *
     * @ActionParam(
     *     name = "Page",
     *     filters = "type=int",
     *     description = "Page number"
     * )
     *
     * @ActionParam(
     *     name = "FindByString",
     *     filters = "type=string",
     *     description = "Find city by string"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d885da0fe4f08e8f7ce46
     *
     * @return Model
     *
     * ToDo: Implement the method
     */
    // public function getCities(array $options = []);


    /**
     * Method "getSettlements" - Get Nova Poshta settlements.
     *
     * @ActionParam(
     *     name = "Ref",
     *     filters = "type=string|maxlen=36",
     *     description = "Address REF"
     * )
     *
     * @ActionParam(
     *     name = "RegionRef",
     *     filters = "type=string|maxlen=36",
     *     description = "Region REF"
     * )
     *
     * @ActionParam(
     *     name = "FindByString",
     *     filters = "type=string|maxlen=36",
     *     description = "Find address by string"
     * )
     *
     * @ActionParam(
     *     name = "Warehouse",
     *     filters = "type=string|maxlen=36",
     *     description = "Warehouse availability filter"
     * )
     *
     * @ActionParam(
     *     name = "Page",
     *     filters = "type=int|max=36",
     *     description = "Page number"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/56248fffa0fe4f0da0550ea8
     *
     * @return Model
     *
     * ToDo: Implement the method
     */
    // public function getSettlements(array $options = []);


    /**
     * Method "getAreas" - Get geographic areas.
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d9130a0fe4f08e8f7ce48
     *
     * @return Model
     *
     * ToDo: Implement the method
     */
    // public function getAreas();


    /**
     * Method "getWarehouses" - Get Nova Poshta warehouses.
     *
     * @ActionParam(
     *     name = "CityName",
     *     filters = "type=string|maxlen=36",
     *     description = "City name"
     * )
     *
     * @ActionParam(
     *     name = "CityRef",
     *     filters = "type=string|maxlen=36",
     *     description = "City REF"
     * )
     *
     * @ActionParam(
     *     name = "Page",
     *     filters = "type=int|max=500",
     *     description = "Page number"
     * )
     *
     * @ActionParam(
     *     name = "Limit",
     *     filters = "type=int|max=10",
     *     description = "Items per page"
     * )
     *
     * @ActionParam(
     *     name = "Language",
     *     filters = "type=string|maxlen=2",
     *     description = "City REF"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d8211a0fe4f08e8f7ce45
     *
     * @return Model
     *
     * ToDo: Implement the method
     */
    // public function getWarehouses(array $options = []);


    /**
     * Method "getWarehouseTypes" - Get Nova Poshta warehouse types.
     *
     * @see https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d8211a0fe4f08e8f7ce45
     *
     * @return Model
     *
     * ToDo: Implement the method
     */
    // public function getWarehouseTypes();


    /**
     * Method "getStreet" - Get Nova Poshta delivery streets.
     *
     * @ActionParam(
     *     name = "CityRef",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "City REF"
     * )
     *
     * @ActionParam(
     *     name = "FindByString",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Find by string"
     * )
     *
     * @ActionParam(
     *     name = "Page",
     *     filters = "type=int|max=10",
     *     description = "Response items count"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/556d8db0a0fe4f08e8f7ce47
     *
     * @return Model
     *
     * ToDo: Implement the method
     */
    // public function getStreet(array $options = []);


    /**
     * Method "searchSettlements" - Search settlements online.
     *
     * @ActionParam(
     *     name = "CityName",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "City name or index (zip)"
     * )
     *
     * @ActionParam(
     *     name = "Limit",
     *     required = true,
     *     filters = "type=int|maxlen=36",
     *     description = "Response items count"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/58e5ebeceea27017bc851d67
     *
     * @return Model
     *
     * ToDo: Implement the method
     */
    // public function searchSettlements(array $options = []);


    /**
     * Method "searchSettlementStreets" - Search streets online.
     *
     * @ActionParam(
     *     name = "StreetName",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Street name"
     * )
     *
     * @ActionParam(
     *     name = "SettlementRef",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "Town REF"
     * )
     *
     * @ActionParam(
     *     name = "Limit",
     *     required = true,
     *     filters = "type=int|maxlen=36",
     *     description = "Response items count"
     * )
     *
     * @link https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43/operations/58e5f369eea27017540b58ac
     *
     * @return Model
     *
     * ToDo: Implement the method
     */
    // public function searchSettlementStreets(array $options = []);
}