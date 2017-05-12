<?php

class Controller_Admin extends Controller {

    function __construct() {
        parent::__construct();
        $this->model = new Model_Admin();
    }

    function action_index() {
//        if (!$this->model->check_permission()) {
//            Route::ErrorPage403();
//            return;
//        }

    $this->view->generate('admin_index_view.php', 'template_view.php');

    }

    public function action_users() {
//        if (!$this->model->check_permission()) {
//            Route::ErrorPage403();
//            return;
//        }

        $users = $this->model->get_users();
        $this->view->generate(
            'admin_users_view.php',
            'template_view.php',
            array('users' => $users)
        );

    }

    public function action_user_update() {
//        if (!$this->model->check_permission()) {
//            Route::ErrorPage403();
//        }

        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            Route::ErrorPage405();
            return;
        }

        if (empty($_POST["id"]) && empty($_POST["permission"]) || !is_numeric($_POST["id"])) {
            Route::redirect("/Admin/users");
            return;
        }

        $user_id = intval($_POST["id"]);

        $permission = strtolower($_POST["permission"]) == "on" ? 1 : 0;

        $this->model->update_user_permission($user_id, $permission);

        Route::redirect("/Admin/users");
    }
}
