<?php

class Controller_Main extends Controller {

    function __construct() {
        parent::__construct();
        $this->model = new Model_Main();
    }

    function action_index() {
        $this->view->generate('main_view.php', 'main_template_view.php');
    }

    function action_login() {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            Route::ErrorPage405();
            return;
        }

        $email = $this->model->escape($_POST["email"]);
        $password = $this->model->escape($_POST["password"]);

        if (empty($_POST["login"]) && empty($email) && empty($password)) {
            Route::redirect("/");
            return;
        }

        if (!preg_match("/^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})$/iD", $email)) {
            Route::redirect("/");
            return;
        }

        if (!$this->model->user_exists($email, $password)) {
            Route::redirect("/");
            return;
        }

        $cookie = sha1(sprintf("%s:%s:%s", time(), $email, $password));

        setcookie("uid", $cookie, 0, "/");
        Route::redirect("/");
    }
}
