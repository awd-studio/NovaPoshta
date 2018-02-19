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

use NP\Common\Util\ActionDoc;
use NP\Common\Util\NPReflectionMethod;
use NP\Exception\Errors;
use ReflectionException;


/**
 * Class ModelBuilder
 * @package NP\Model
 */
class ModelBuilder
{

    /**
     * Build model object.
     *
     * @param string $modelName    API model name.
     * @param string $calledMethod Model method.
     * @param array  $data         Data to send.
     *
     * @return Model|null
     */
    public static function build(string $modelName, string $calledMethod, array $data = [])
    {
        $model = null;
        $modelClass = __NAMESPACE__ . '\\' . $modelName; // Build full model name

        // Try to fetch model reflection with called method.
        // Catch Reflection exception if model or method is unavailable.
        try {
            // Replacing called method name with [*Action] suffix.
            $reflectionMethod = new NPReflectionMethod($modelClass, "{$calledMethod}Action");

            // Get method parameters from annotation
            $params = (new ActionDoc($reflectionMethod))->getAnnotation('ActionParam');

            // Create model
            $model = $reflectionMethod->invoke(new $modelClass($data, $params));
            $model->setModelName($modelName);
            $model->setCalledMethod($calledMethod);
        } catch (ReflectionException $exception) {
            $message = "Undefined model or method \"$modelClass::$calledMethod\"!";
            $message .= ' Error: ';
            $message .= $exception->getMessage();

            Errors::getInstance()->addError($message);
        }

        return $model;
    }
}
