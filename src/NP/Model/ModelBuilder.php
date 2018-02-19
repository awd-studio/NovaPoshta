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

use NP\Common\Config;
use NP\Common\Util\ActionDoc;
use NP\Common\Util\NPReflectionMethod;
use NP\Exception\Errors;
use ReflectionException;


/**
 * Class ModelBuilder
 * @package NP\Model
 */
class ModelBuilder implements ModelBuilderInterface
{

    /**
     * @var string API key.
     */
    private $apiKey;

    /**
     * @var string Model name.
     */
    private $modelName;

    /**
     * @var string Model called method.
     */
    private $calledMethod;

    /**
     * @var object Method properties.
     */
    private $methodProperties;


    /**
     * Set apiKey parameter.
     *
     * @param string $apiKey
     *
     * @return ModelBuilder
     */
    public function setApiKey(string $apiKey): ModelBuilder
    {
        $this->apiKey = $apiKey;

        return $this;
    }


    /**
     * Set modelName parameter.
     *
     * @param string $modelName
     *
     * @return ModelBuilder
     */
    public function setModelName(string $modelName): ModelBuilder
    {
        $this->modelName = $modelName;

        return $this;
    }


    /**
     * Set calledMethod parameter.
     *
     * @param string $calledMethod
     *
     * @return ModelBuilder
     */
    public function setCalledMethod(string $calledMethod): ModelBuilder
    {
        $this->calledMethod = $calledMethod;

        return $this;
    }


    /**
     * Set methodProperties parameter.
     *
     * @param mixed $methodProperties
     *
     * @return ModelBuilder
     */
    public function setMethodProperties($methodProperties): ModelBuilder
    {
        $this->methodProperties = (object) $methodProperties;

        return $this;
    }


    /**
     * Build model object.
     *
     * @param Config $config       API config
     * @param string $modelName    API model name.
     * @param string $calledMethod Model method.
     * @param array  $data         Data to send.
     *
     * @return ModelBuilderInterface
     */
    public static function build(
        Config $config,
        string $modelName,
        string $calledMethod,
        array $data = []
    ): ModelBuilderInterface {
        $modelBuilder = new static();
        $modelBuilder->setApiKey($config->getKey())
            ->setModelName($modelName)
            ->setCalledMethod($calledMethod);

        $modelClass = __NAMESPACE__ . '\\' . $modelName; // Build full model name

        // Try to fetch model reflection with called method.
        // Catch Reflection exception if model or method is unavailable.
        try {
            // Replacing called method name with [*Action] suffix.
            $reflectionMethod = new NPReflectionMethod($modelClass, "{$calledMethod}Action");

            // Get method parameters from annotation
            $params = (new ActionDoc($reflectionMethod))->getAnnotation('ActionParam');

            // Create model
            /** @var Model $model */
            $model = $reflectionMethod->invoke(new $modelClass($data, $params));
            $modelBuilder->setMethodProperties($model->getMethodProperties());
        } catch (ReflectionException $exception) {
            $message = "Undefined model or method \"$modelClass::$calledMethod\"!";
            $message .= ' Error: ';
            $message .= $exception->getMessage();

            Errors::getInstance()->addError($message);
        }

        return $modelBuilder;
    }


    /**
     * Get serialized object.
     *
     * @return object
     */
    public function getBody()
    {
        return get_object_vars($this);
    }
}
