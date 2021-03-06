<?php

class Router{
    private $routes;

    public function __construct(){
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    // метод возвращает строку
    private function getUri() {
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run(){

        // Получаем строку запроса
        $uri = $this->getUri();

        // Проверяем наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path) {

            // сравниваем $uriPattern и $path
            if (preg_match("~$uriPattern~", $uri)) {

                // Определяем какой контроллер и action обрабатывают запрос
                $segments = explode('/', $path);

                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action'.ucfirst(array_shift($segments));

                // Подключаем файл класса-контроллера
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

                if(file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // Создаем объект и вызываем метод
                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();
                if ($result != null) {
                    break;
                }
            }
        }
    }
}
