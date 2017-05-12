<?php

class Controller_Rating extends Controller {

    function __construct() {
        parent::__construct();
        $this->model = new Model();
    }

    function action_index() {
        $data = $this->model->get_user_by_session();

        if (!$data) {
            Route::redirect("/");
            return;
        }

        $this->view->generate('rating_view.php', 'template_view.php', $data);
    }

}