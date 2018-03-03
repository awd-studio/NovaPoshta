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
 * Class Address
 * @package NP\Model
 */
class Address extends Model implements AddressInterface
{

    /**
     * Method "searchSettlements" - Search settlements online.
     *
     * @param array $options
     *
     * @ActionParam(
     *     name = "CityName",
     *     required = true,
     *     filters = "type=string|maxlen=36",
     *     description = "City name or index/zip"
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
     */
    public function searchSettlementsAction(array $options = [])
    {
        return $this;
    }


    /**
     * Method "getCities" - Get cities.
     *
     * @param array $options
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
     */
    public function getCitiesAction(array $options = [])
    {
        return $this;
    }
}
