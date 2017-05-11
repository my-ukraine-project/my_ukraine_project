<?php

class Route {

    static function start() {

        ini_set('log_errors', 'On');
//        ini_set('error_log', '/var/log/php-scripts.log');

        // контроллер и действие по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';

        //разбиваем uri на страницы
        $routes = explode('?', $_SERVER['REQUEST_URI'], 2);
        $routes = explode('/', $routes[0]);

        // получаем имя контроллера, начинаем с первого, т.к. 0й элемент - dns-адрес хоста
        if (!empty($routes[1])) {
            $controller_name = $routes[1];
        }

        // получаем имя экшена
        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }

        // добавляем префиксы
        $model_name = 'Model_' . $controller_name;
        $controller_name = 'Controller_' . $controller_name;
        $action_name = 'Action_' . $action_name;

        // подцепляем файл с классом модели (файла может и не быть)

        $model_file = strtolower($model_name) . '.php';
        $model_path = "application/models/" . $model_file;

        if (file_exists($model_path)) {
            include "application/models/" . $model_file;
        }

        // подцепляем файл с классом контроллера

        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = "application/controllers/" . $controller_file;
        if (file_exists($controller_path)) {
            include "application/controllers/" . $controller_file;
        } else {
            /*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
            Route::ErrorPage404();
        }

        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;

        if (method_exists($controller, $action)) {
            // вызываем действие контроллера
            $controller->$action();
        } else {
            // здесь также разумнее было бы кинуть исключение
//            Route::ErrorPage404();
        }
    }

    static function redirect($page) {
        $host = 'http://' . $_SERVER['HTTP_HOST'];
        header('Location:' . $host . $page);
    }

    static function ErrorPage403() {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 403 Forbidden');
        header("Status: 403 Forbidden");
        header('Location:' . $host . '403');
    }

    static function ErrorPage404() {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }

    static function ErrorPage405() {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 405 Method Not Allowed');
        header("Status: 405 Method Not Allowed");
        header('Location:' . $host . '405');
    }
}
