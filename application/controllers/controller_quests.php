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
            return;
        }

        $quests = $this->model->get_quests();

        $quests = array_map(function ($item) {
            $item["data"] = json_decode($item["data"]);
            return (object)$item;
        }, $quests);

        $data = array("user" => $user, "quests" => $quests);

        $this->view->generate('quests_view.php', 'template_view.php', $data);
    }


    function handle_question($num) {
        $obj = (object)array();

        if (empty($_POST["content". $num])) {
            return null;
        }

        $obj->type = $_POST["content". $num];

        if (empty($_POST["question". $num])) {
            return null;
        }

        $obj->question = $_POST["question". $num];

        if (!in_array($obj->type, array("text", "video", "map", "image", "puzzle"))) {
            return null;
        }

        if (!isset($_POST["answer". $num ."-1"]) || empty($_POST["answer". $num ."-1"])) {
            return null;
        }

        if (!isset($_POST["answer". $num ."-2"]) || empty($_POST["answer". $num ."-2"])) {
            return null;
        }

        if (!isset($_POST["answer". $num ."-3"]) || empty($_POST["answer". $num ."-3"])) {
            return null;
        }

        if (!isset($_POST["answer". $num ."-4"]) || empty($_POST["answer". $num ."-4"])) {
            return null;
        }

        $obj->a1 = (object)array(
            "text" => $_POST["answer". $num ."-1"],
            "right" => (isset($_POST["right-answer". $num ."-1"]) && $_POST["right-answer". $num ."-1"] == "on")
        );

        $obj->a2 = (object)array(
            "text" => $_POST["answer". $num ."-2"],
            "right" => (isset($_POST["right-answer". $num ."-2"]) && $_POST["right-answer". $num ."-2"] == "on")
        );
        $obj->a3 = (object)array(
            "text" => $_POST["answer". $num ."-3"],
            "right" => (isset($_POST["right-answer". $num ."-3"]) && $_POST["right-answer". $num ."-3"] == "on")
        );

        $obj->a4 = (object)array(
            "text" => $_POST["answer". $num ."-4"],
            "right" => (isset($_POST["right-answer". $num ."-4"]) && $_POST["right-answer". $num ."-4"] == "on")
        );

        $arr = array($obj->a1->right, $obj->a2->right, $obj->a3->right, $obj->a4->right);
        $right = count(array_filter($arr, function ($item) { return !!$item; }));
        if ($right >= 1 && $right < 4) {
            return null;
        }

        if (in_array($obj->type, array("text", "video", "map"))) {
            $obj->content = $_POST[$obj->type . $num];
        }

        if (in_array($obj->type, array("image", "puzzle"))) {
            $file = $_FILES[$obj->type . $num];

            if ($file["size"] > MAX_IMAGE_FILE_SIZE) {
                return null;
            }

            if (!in_array($file["type"], array("image/png", "image/gif", "image/jpeg"))) {
                return null;
            }

            $extension = pathinfo(basename($file["name"]),PATHINFO_EXTENSION);
            if (!in_array($extension, array("jpeg", "jpg", "png", "gif"))) {
                return null;
            }

            $hash = md5_file($file["tmp_name"]);

            $obj->content = UPLOADS_DIR . DIRECTORY_SEPARATOR . $hash .".". $extension;

            if (!file_exists(UPLOADS_DIR)) {
                mkdir(UPLOADS_DIR);
            }

            if (!file_exists($obj->content)) {
                if (!move_uploaded_file($file["tmp_name"], $obj->content)) {
                    echo "Ошибка при перемещении файла!";
                }
            }
        }

        return $obj;
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

        $quest = (object)array("questions" => array());

        if (empty($_POST["quest-name"])) {
            return;
        }

        if (empty($_POST["quest-target"])) {
            return;
        }

        $quest->name = $_POST["quest-name"];
        $quest->target = $_POST["quest-target"];

        array_push($quest->questions, $this->handle_question(1));
        array_push($quest->questions, $this->handle_question(2));
        array_push($quest->questions, $this->handle_question(3));
        array_push($quest->questions, $this->handle_question(4));
        array_push($quest->questions, $this->handle_question(5));

        $quest->questions = array_filter($quest->questions, function ($item) { return !!$item; });

        if (count($quest->questions) != 5) {
            echo "Не все вопросы квеста были заполнены, вернитесь назад и проверьте форму!<br>";
            echo '<a href="#" onClick="history.go(-1)"> НАЗАД </a>';
            return;
        }

        $data = $this->model->get_user_by_session();

        if (!$this->model->add_quest($data, $quest)) {
            echo json_encode(array("status" => false, "msg" => "Ошибка при записи в бд!"));
            return;
        }

        Route::redirect("/Quests/add");
    }
}