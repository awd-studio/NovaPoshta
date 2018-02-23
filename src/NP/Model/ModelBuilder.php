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
use ReflectionException;


/**
 * Class ModelBuilder
 *
 * @property string apiKey
 * @property string modelName
 * @property string calledMethod
 * @property array  methodProperties
 * @property string error
 *
 * @package NP\Model
 */
class ModelBuilder implements ModelBuilderInterface
{

    /**
     * Build model object.
     *
     * @param Config $config       API config
     * @param string $modelName    API model name.
     * @param string $calledMethod Model method.
     * @param array  $data         Data to send.
     *
     * @return ModelBuilderInterface
     *
     * ToDo: Refactor;
     */
    public static function build(
        Config $config,
        string $modelName,
        string $calledMethod,
        array $data = []
    ): ModelBuilderInterface {
        $modelBuilder = new static();

        if ($errors = $config->getErrors()) {
            $modelBuilder->error = implode('; ', $errors);
        } else {
            $modelClass = __NAMESPACE__ . '\\' . $modelName; // Build full model name

            // Try to fetch model reflection with called method.
            // Catch Reflection exception if model or method is unavailable.
            try {
                // Replacing called method name with [*Action] suffix.
                $reflectionMethod = new NPReflectionMethod($modelClass, "{$calledMethod}Action");

                // Get method parameters from annotation
                $params = (new ActionDoc($reflectionMethod))->getAnnotation('ActionParam');

                // Create model
                /* @var Model $model */
                $model = $reflectionMethod->invoke(new $modelClass($data, $params));

                // Set properties
                $modelBuilder->apiKey = $config->getKey();
                $modelBuilder->modelName = $modelName;
                $modelBuilder->calledMethod = $calledMethod;
                $modelBuilder->methodProperties = $model->getMethodProperties();
            } catch (ReflectionException $exception) {
                $modelBuilder->error = "Undefined model or method \"$modelClass::$calledMethod\"!";
                $modelBuilder->error .= ' Error: ';
                $modelBuilder->error .= $exception->getMessage();
            } catch (\Exception $exception) {
                $modelBuilder->error = $exception->getMessage();
            }
        }

        return $modelBuilder;
    }


    /**
     * Has error.
     *
     * @return bool
     */
    public function hasError(): bool
    {
        return isset($this->error);
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
