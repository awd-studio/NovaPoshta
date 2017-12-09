<?php

/**
 * @file
 * This file is part of Nova-Poshta PHP library.
 *
 * @author   Anton Karpov <awd.com.ua@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     https://github.com/awd-studio/nova-poshta
 */

namespace NP\Entity;


/**
 * Class Track
 *
 * @package NP\Entity
 */
class Track
{

    /**
     * Document Tracking Number.
     *
     * @var string
     */
    protected $documentNumber;

    /**
     * Phone Number.
     *
     * @var string
     */
    protected $phone;


    /**
     * Track constructor.
     *
     * @param mixed  $documentNumber
     * @param string $phone
     */
    public function __construct($documentNumber, $phone = '')
    {
        if (is_array($documentNumber)) {

            if (isset($documentNumber['DocumentNumber'])) {
                $this->documentNumber = $documentNumber['DocumentNumber'];
            } elseif (isset($documentNumber[0])) {
                $this->documentNumber = $documentNumber[0];
            }

            if (isset($documentNumber['Phone'])) {
                $this->phone = $documentNumber['Phone'];
            } elseif (isset($documentNumber[1])) {
                $this->phone = $documentNumber[1];
            }

        } elseif (is_string($documentNumber)) {
            $this->documentNumber = $documentNumber;
        }

        if ($this->phone === null) {
            $this->phone = $phone;
        }
    }


    /**
     * Get Track ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->documentNumber;
    }


    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }


    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }


    /**
     * Build track.
     *
     * @return array
     */
    public function build()
    {
        return [
          'DocumentNumber' => $this->documentNumber,
          'Phone'          => $this->phone,
        ];
    }


    /**
     * Create static Track number.
     *
     * @param mixed  $documentNumber
     * @param string $phone
     *
     * @return self
     */
    public static function create($documentNumber, $phone = '')
    {
        return new self($documentNumber, $phone);
    }
}
