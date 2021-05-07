<?php

namespace Neuffer\FileHandler;

/**
 * Class ActionLoader
 * @method
 * @package src\FileHandler
 */
class ActionLoader
{
    /**
     * @param $action
     * @return AbstractAction
     * @throws \Exception
     */
    public function getAction($action)
    {
        $className = sprintf('%sAction', ucfirst($action));
        $classPath = __NAMESPACE__. '\\' . $className;
        if (!class_exists($classPath)) {
            throw new \Exception("Wrong action is selected");
        }

        $classObject = new $classPath();
        return $classObject;
    }
}