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
        $data = (object)array("user" => $user, "quests" => $quests);

        $this->view->generate('quests_view.php', 'template_view.php', $data);
    }

    function action_passing() {
        $user = $this->model->get_user_by_session();
        if (!$user) {
            Route::redirect("/");
            return;
        }

        if (!isset($_GET["q"]) || empty($_GET["q"]) || !is_numeric($_GET["q"])) {
            Route::redirect("/Quests");
            return;
        }

        $quest = $this->model->get_quest_by_id(intval($_GET["q"]));
        if (!$quest) {
            Route::ErrorPage404();
            return;
        }

        $data = array("user" => $user, "quest" => $quest);

        $this->view->generate('quests_passing_view.php', 'template_view.php', $data);
    }


    function handle_question($num) {
        $obj = (object)array();

        if (empty($_POST["content". $num])) {
            echo "empty(\$_POST[\"content$num\"])";
            return null;
        }

        $obj->type = $_POST["content". $num];


        if (!in_array($obj->type, array("text", "video", "map", "image", "puzzle"))) {
            echo "Unknown content type!";
            return null;
        }

        if ($obj->type !== "puzzle") {

            if (empty($_POST["question". $num])) {
                echo "empty(\$_POST[\"question$num\"])";
                return null;
            }

            $obj->question = $_POST["question". $num];

            if (!isset($_POST["answer". $num ."-1"]) || empty($_POST["answer". $num ."-1"])) {
                echo "answer$num-1 not set or empty";
                return null;
            }

            if (!isset($_POST["answer". $num ."-2"]) || empty($_POST["answer". $num ."-2"])) {
                echo "answer$num-2 not set or empty";
                return null;
            }

            if (!isset($_POST["answer". $num ."-3"]) || empty($_POST["answer". $num ."-3"])) {
                echo "answer$num-3 not set or empty";
                return null;
            }

            if (!isset($_POST["answer". $num ."-4"]) || empty($_POST["answer". $num ."-4"])) {
                echo "answer$num-4 not set or empty";
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

            if (!($right >= 1 && $right < 4)) {
                echo "Правильных ответов должно быть больше одного но меньше 4х";
                return null;
            }
        }

        if (in_array($obj->type, array("text", "video", "map"))) {

            if (!isset($_POST[$obj->type . $num]) || empty($_POST[$obj->type . $num])) {
                echo "Не заполнено текстовое поле для эелемента ". $obj->type;
                return null;
            }

            $obj->content = $_POST[$obj->type . $num];
        }

        if (in_array($obj->type, array("image", "puzzle"))) {
            $file = $_FILES[$obj->type . $num];

            if (!isset($_FILES[$obj->type . $num]) || empty($_FILES[$obj->type . $num])) {
                echo "Не выбрано изображение";
                return null;
            }

            if ($file["size"] > MAX_IMAGE_FILE_SIZE) {
                echo "Максимально допустимый вес изображения ". MAX_IMAGE_FILE_SIZE ." (bytes)";
                return null;
            }

            if (!in_array($file["type"], array("image/png", "image/gif", "image/jpeg"))) {
                echo "Изображение не соответствует ни одному из поддерживаемых форматов image/png, image/gif, image/jpeg.";
                return null;
            }

            $extension = pathinfo(basename($file["name"]),PATHINFO_EXTENSION);
            if (!in_array(strtolower($extension), array("jpeg", "jpg", "png", "gif"))) {
                echo $file["name"];
                echo "Изображение не поддерживается: поддерживаемые \"jpeg\", \"jpg\", \"png\", \"gif\".";
                return null;
            }

            $hash = md5_file($file["tmp_name"]);

            $obj->content = UPLOADS_DIR . "/" . $hash .".". $extension;

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

    public function action_add() {
//        if (!$this->model->check_permission()) {
//            Route::ErrorPage403();
//            return;
//        }

        $user = $this->model->get_user_by_session();

        if (!$user) {
            Route::redirect("/");
            return;
        }


        if ($_SERVER["REQUEST_METHOD"] != "POST" && !isset($_GET["edit"])) {
            $data = (object)array("user" => $user);
            $this->view->generate('quests_add_view.php', 'template_view.php', $data);
            return;
        } else if ($_SERVER["REQUEST_METHOD"] != "POST" && isset($_GET["edit"])) {

            if (!isset($_GET["edit"]) || empty($_GET["edit"]) || !is_numeric($_GET["edit"])) {
                Route::ErrorPage404();
                return;
            }

            $q_object = $this->model->get_quest_by_id(intval($_GET["edit"]));

            if (empty($q_object)) {
                Route::ErrorPage404();
            }

            $data = (object)array("user" => $user, "quest" => $q_object);

            $this->view->generate('quests_edit_view.php', 'template_view.php', $data);
        }

        $quest = (object)array("questions" => array());

        if (empty($_POST["quest-name"])) {
            echo 'empty($_POST["quest-name"])';
            return;
        }

        if (empty($_POST["quest-target"])) {
            echo 'empty($_POST["quest-target"])';
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

        if (!isset($_POST["quest-id"]) || empty($_POST["quest-id"]) || !is_numeric($_POST["quest-id"])) {

            $data = $this->model->get_user_by_session();

            if (!$this->model->add_quest($data, $quest)) {
                echo json_encode(array("status" => false, "msg" => "Ошибка при записи в бд!"));
                return;
            }

            Route::redirect("/Quests/add");

        } else {
            $qid = intval($_POST["quest-id"]);

            if (!$this->model->update($qid, $quest)) {
                echo json_encode(array("status" => false, "msg" => "Ошибка при записи в бд!"));
                return;
            }

            Route::redirect("/Quests/passing?q=$qid");
        }
    }

    public function action_pass() {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            Route::ErrorPage405();
            return;
        }

        if (!isset($_POST["qid"]) || empty($_POST["qid"]) || !is_numeric($_POST["qid"])) {
            return;
        }

        $quest = $this->model->get_quest_by_id(intval($_POST["qid"]));

        print_r($_POST);



    }
}