<?php

namespace Api\Core;

use Exception;

class ConsoleApplication extends BaseApplication
{
    public function run(): void
    {
        try {
            $controllerName = preg_replace('/\./isu', '\\', $_SERVER['argv'][1]);
            $actionName = $_SERVER['argv'][2];
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
            } else {
                return;
            }
            if (method_exists($controller, $actionName)) {
                echo $controller->$actionName();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return;
        }
    }
}
