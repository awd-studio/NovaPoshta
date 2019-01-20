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

interface PostDataInterface
{
    /**
     * Set model name.
     *
     * @param string $modelName
     *
     * @return \AwdStudio\NovaPoshta\Entity\PostDataInterface
     */
    public function setModelName(string $modelName): self;

    /**
     * Set called method.
     *
     * @param string $calledMethod
     *
     * @return \AwdStudio\NovaPoshta\Entity\PostDataInterface
     */
    public function setCalledMethod(string $calledMethod): self;

    /**
     * Set called method.
     *
     * @param array $methodProperties
     *
     * @return \AwdStudio\NovaPoshta\Entity\PostDataInterface
     */
    public function setMethodProperties(array $methodProperties): self;

    /**
     * Set an API key.
     *
     * @param string $apiKey
     *
     * @return \AwdStudio\NovaPoshta\Entity\PostDataInterface
     */
    public function setApiKey(string $apiKey): self;

    /**
     * Data to post.
     *
     * @return array
     *
     * @throws \AwdStudio\NovaPoshta\Exception\WrongHttpDataException
     */
    public function getPostData(): array;
}