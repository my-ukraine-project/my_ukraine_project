<?php

class Controller_Information extends Controller {

    function __construct() {
        parent::__construct();
        $this->model = new Model();
    }

    function action_index() {
        $data = $this->model->get_user_by_session();

        if (!$data) {
            Route::redirect("/");
        }

        $this->view->generate('information_view.php', 'template_view.php', $data);
    }

}