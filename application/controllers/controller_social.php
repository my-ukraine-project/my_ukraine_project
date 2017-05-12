<?php

class Controller_Social extends Controller {

    function __construct() {
        parent::__construct();
        $this->model = new Model();
    }

    function action_index() {
        $s = file_get_contents(
            'http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']
        );

        $cookie = sha1(sprintf("%s:%s", $s, time()));
        setcookie("uid", $cookie, time() + SESSION_COOKIE_TTL, "/");
        $_SESSION["user"] = json_decode($s, true);
        Route::redirect("/");

        //$user['network'] - соц. сеть, через которую авторизовался пользователь
        //$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
        //$user['first_name'] - имя пользователя
        //$user['last_name'] - фамилия пользователя
    }

}
