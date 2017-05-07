<?php

class Controller_Quests extends Controller {

    function __construct() {
        parent::__construct();
        $this->model = new Model_Quests();
    }

    function action_index() {
        $user = $this->model->get_user_by_session();

        if (!$user) {
            Route::redirect("/");
        }

        $quests = $this->model->get_quests();

        $quests = array_map(function ($item) {
            $item["data"] = json_decode($item["data"]);
            return (object)$item;
        }, $quests);

        $data = array("user"=> $user, "quests"=> $quests);

        $this->view->generate('quests_view.php', 'template_view.php', $data);
    }

    function action_add() {
        if (!$this->model->check_permission()) {
            Route::ErrorPage403();
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            $this->view->generate('quests_add_view.php', 'template_view.php');
            return;
        }

        if (empty($_POST["quest"])) {
            echo json_encode(array("status" => false, "msg" => "пустой квест!"));
            return;
        }

        $quest = (object)json_decode($_POST["quest"]);

        if (!isset($quest->type) || !in_array($quest->type, array(1, 2, 3, 4))) {
            echo json_encode(array("status" => false, "msg" => "неизвестный тип контента"));
            return;
        }

        if (!isset($quest->content) || empty($quest->content)) {
            echo json_encode(array("status" => false, "msg" => "контент пуст!"));
            return;
        }
        if (!isset($quest->target) || empty($quest->target)) {
            echo json_encode(array("status" => false, "msg" => "Не указана цель квеста!"));
            return;
        }

        if (!isset($quest->answers) || !(count($quest->answers) > 1)) {
            echo json_encode(array("status" => false, "msg" => "количество ответов должно быть больше одного!"));
            return;
        }


        $cnt = count(array_filter($quest->answers, function ($item) { return $item->checked; }));

        if (!$cnt) {
            echo json_encode(array("status" => false, "msg" => "не установлен правильный ответ!"));
            return;
        }

        $answer_type = ($cnt > 1) ? "checkbox" : "radio";

        $object = (object)array(
            "type" => $quest->type,
            "target" => $quest->target,
            "content" => $quest->content,
            "answers" => array()
        );

        foreach ($quest->answers as $item) {
            array_push($object->answers, array(
                "right" => $item->checked,
                "type" => $answer_type,
                "name" => $item->name,
                "text"=> $item->text
            ));
        }

        $data = $this->model->get_user_by_session();
        if (!$this->model->add_quest($data, $object)) {
            echo json_encode(array("status" => false, "msg" => "Ошибка при записи в бд!"));
            return;
        }

        echo json_encode(array("status" => true, "msg" => "Успешно добвлен!"));
    }


}