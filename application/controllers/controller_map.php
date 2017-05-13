<?php

class Controller_Map extends Controller {

    function action_index() {
        $this->view->generate('map_view.php', 'template_view.php');
    }
}
