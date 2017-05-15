<?php

class Controller_Rating extends Controller {

    function __construct() {
        parent::__construct();
        $this->model = new Model();
    }

    function action_index() {
        $user = $this->model->get_user_by_session();

        if (!$user) {
            Route::redirect("/");
            return;
        }

        $user->progress = $this->model->get_progress($user->id);
        $data = (object)array("user" => $user, "ratings"=> $this->model->get_rating());
        $this->view->generate('rating_view.php', 'template_view.php', $data);
    }

}