<?php

class Controller_Settings extends Controller {

    function __construct() {
        parent::__construct();
        $this->model = new Model_Settings();
    }

    function action_index() {
        $data = $this->model->get_user_by_session();

        if (!$data) {
            Route::redirect("/");
            return;
        }

        $data = $this->model->get_user_full($data);
        $data->progress = $this->model->get_progress($data->id);

        $this->view->generate('settings_view.php', 'template_view.php', $data);
    }

    function action_save() {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            Route::ErrorPage405();
            return;
        }

        $data = $this->model->get_user_by_session();
        if (!$data) {
            Route::redirect("/");
            return;
        }

        if (empty($_POST["settings-name"]) || empty($_POST["settings-email"]) || empty($_POST["settings-password"]) ||  empty($_POST["settings-password-repeat"]) || empty($_POST["settings-phone"]) || empty($_POST["settings-city"]) || empty($_POST["settings-school"])|| empty($_POST["save"])) {
            Route::redirect("/Settings");
            return;
        }


        $fio = $this->model->escape($_POST["settings-name"]);
        $email = $this->model->escape($_POST["settings-email"]);
        $password = $this->model->escape($_POST["settings-password"]);
        $password2 = $this->model->escape($_POST["settings-password-repeat"]);
        $phone = $this->model->escape($_POST["settings-phone"]);
        $city = $this->model->escape($_POST["settings-city"]);
        $school = $this->model->escape($_POST["settings-school"]);

        if ($password != $password2) {
            Route::redirect("/Settings");
            return;
        }

        if ($data->email != $email) {

            if (!preg_match("/^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})$/iD", $email)) {
                Route::redirect("/Settings");
                return;
            }

            if ($this->model->mail_exists($email)) {
                Route::redirect("/Settings");
                return;
            }
        }

        if (!$this->model->save_settings($data, $fio, $email, $password, $phone, $city, $school)) {
            echo "ошибка";
            return;
        }

        Route::redirect("/Settings");
    }
}