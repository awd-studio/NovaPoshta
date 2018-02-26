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
use NP\Exception\ErrorException;
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
     * @param Config       $config       API config
     * @param Model|string $model        API model name or model class.
     * @param string       $calledMethod Model method.
     * @param array        $data         Data to send.
     *
     * @return ModelBuilderInterface
     *
     * ToDo: Refactor;
     */
    public static function build(Config $config, $model, string $calledMethod, array $data = []): ModelBuilderInterface
    {
        $modelBuilder = new static();

        if ($errors = $config->getErrors()) {
            $modelBuilder->error = implode('; ', $errors);
        } else {
            // Try to fetch model reflection with called method.
            // Catch Reflection exception if model or method is unavailable.
            try {
                if (is_string($model)) {
                    $modelClass = __NAMESPACE__ . '\\' . $model; // Build full model name
                } elseif ($model instanceof Model) {
                    $modelClass = $model;
                } else {
                    $unexpected = (string) $model;
                    throw new ErrorException("Unexpected Model \"{$unexpected}\"");
                }

                // Replacing called method name with [*Action] suffix.
                $reflectionMethod = new NPReflectionMethod($modelClass, "{$calledMethod}Action");

                // Get method parameters from annotation
                $params = (new ActionDoc($reflectionMethod))->getAnnotation('ActionParam');

                // Create model
                /* @var Model $model */
                $reflectionModel = $reflectionMethod->invoke(new $modelClass($data, $params));

                // Set properties
                $modelBuilder->apiKey = $config->getKey();
                // $modelBuilder->modelName = ($modelClass);
                $modelBuilder->modelName = (new \ReflectionClass($modelClass))->getShortName();
                $modelBuilder->calledMethod = $calledMethod;
                $modelBuilder->methodProperties = $reflectionModel->getMethodProperties();
            } catch (ReflectionException $exception) {
                $modelBuilder->error = "Undefined model or method!";
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
        return (isset($this->error) && $this->error);
    }


    /**
     * Get serialized object.
     *
     * @return array
     */
    public function getBody()
    {
        return get_object_vars($this);
    }
}
