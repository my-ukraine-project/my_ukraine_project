<?php

class Controller_Main extends Controller
{

    function action_index()
    {
        $this->view->generate('auth_view.php', 'auth_template_view.php');
    }
}
