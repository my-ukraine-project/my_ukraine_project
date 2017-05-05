<?php

class Controller_SignUp extends Controller {

    function __construct() {
        parent::__construct();
        $this->model = new Model_SignUp();
    }

    function action_index() {
        $this->view->generate('signup_view.php', 'template_view.php');
    }

    function action_register() {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            Route::ErrorPage405();
            return;
        }

        $fio = $this->model->escape($_POST["fio"]);
        $email = $this->model->escape($_POST["email"]);
        $password = $this->model->escape($_POST["password"]);

        if (empty($_POST["register"]) && empty($fio) && empty($email) && empty($password)) {
            Route::redirect("/SignUp");
            return;
        }

        if (!preg_match("/^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})$/iD", $email)) {
            Route::redirect("/SignUp");
            return;
        }

        if ($this->model->mail_exists($email)) {
            Route::redirect("/SignUp");
            return;
        }

        if (!$this->model->register($fio, $email, $password)) {
            echo "незарегался";
            return;
        }

        Route::redirect("/");
    }
}
