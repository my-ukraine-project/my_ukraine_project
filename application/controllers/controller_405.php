<?php

/**
 *
 */
class Controller_405 extends Controller {

    function action_index() {
        $this->view->generate('405_view.php', 'template_view.php');
    }
}
