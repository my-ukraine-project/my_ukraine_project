<?php

class Controller_Main extends Controller {

    function __construct() {
        parent::__construct();
        $this->model = new Model_Main();
    }

    function action_index() {
        $data = $this->model->get_user_by_session();
        if (!$data) {
            $this->view->generate('main_view.php', 'main_template_view.php');
        } else {
            echo "Вы вошли как: ". $data->email .":". $data->fio;
        }

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

        $data = $this->model->get_user($email, $password);
        if (!$data) {
            Route::redirect("/");
            return;
        }

        $cookie = sha1(sprintf("%s:%s:%s", time(), $email, $password));
        $this->model->save_session($data->id, $cookie, time() + SESSION_COOKIE_TTL);

        setcookie("uid", $cookie, time() + SESSION_COOKIE_TTL, "/");
        Route::redirect("/");
    }
}
