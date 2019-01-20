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

namespace AwdStudio\NovaPoshta\Entity;

use AwdStudio\NovaPoshta\Exception\WrongHttpDataException;

/**
 * Class PostData
 * Creates data for the POST request.
 *
 * @package AwdStudio\NovaPoshta\Entity
 */
class PostData implements PostDataInterface
{
    /** @var string */
    private $modelName;

    /** @var string */
    private $calledMethod;

    /** @var array */
    private $methodProperties;

    /** @var string */
    private $apiKey;

    /**
     * Set model name.
     *
     * @param string $modelName
     *
     * @return \AwdStudio\NovaPoshta\Entity\PostDataInterface
     */
    public function setModelName(string $modelName): PostDataInterface
    {
        $this->modelName = $modelName;

        return $this;
    }

    /**
     * Set called method.
     *
     * @param string $calledMethod
     *
     * @return \AwdStudio\NovaPoshta\Entity\PostDataInterface
     */
    public function setCalledMethod(string $calledMethod): PostDataInterface
    {
        $this->calledMethod = $calledMethod;

        return $this;
    }

    /**
     * Set called method.
     *
     * @param array $methodProperties
     *
     * @return \AwdStudio\NovaPoshta\Entity\PostDataInterface
     */
    public function setMethodProperties(array $methodProperties): PostDataInterface
    {
        $this->methodProperties = $methodProperties;

        return $this;
    }

    /**
     * Set an API key.
     *
     * @param string $apiKey
     *
     * @return \AwdStudio\NovaPoshta\Entity\PostDataInterface
     */
    public function setApiKey(string $apiKey): PostDataInterface
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Throw an exception if conditions are not appropriated.
     *
     * @param bool $throw The flag to throw an exception.
     * @param string|null $message An exception message.
     *
     * @throws \AwdStudio\NovaPoshta\Exception\WrongHttpDataException
     */
    public function throwWrongHttpDataException(bool $throw, ?string $message = null)
    {
        if ($throw) {
            throw new WrongHttpDataException($message);
        }
    }

    /**
     * Data to post.
     *
     * @return array
     *
     * @throws \AwdStudio\NovaPoshta\Exception\WrongHttpDataException
     */
    public function getPostData(): array
    {
        $this->throwWrongHttpDataException($this->modelName === null, 'Model name is not defined.');
        $this->throwWrongHttpDataException($this->calledMethod === null, 'Called method is not defined.');
        $this->throwWrongHttpDataException($this->methodProperties === null, 'Method properties are not defined.');
        $this->throwWrongHttpDataException($this->apiKey === null, 'API key is not defined.');

        return get_object_vars($this);
    }
}
