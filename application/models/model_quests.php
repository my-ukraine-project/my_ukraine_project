<?php

class Model_Quests extends Model {

    public function add_quest($user, $object) {
        $quest = base64_encode(json_encode($object));
        $ret = $this->mysqli->query("INSERT INTO Quests (data, user_id) VALUE ('$quest', $user->id)");

        echo "mysqli_error: ". mysqli_error($this->mysqli);

        return $ret && ($this->mysqli->affected_rows == 1);
    }

    public function get_quests() {
        $ret = $this->mysqli->query(
        "SELECT q.*, u.fio FROM
                    Quests AS q JOIN Users AS u ON q.user_id = u.id
                LIMIT 100;");

        if (!$ret) {
            return null;
        }

        return array_map(function ($item) {
            $item["data"] = json_decode(base64_decode($item["data"]));
            return (object)$item;
        }, $ret->fetch_all( MYSQLI_ASSOC ));
    }


    public function get_quest_by_id($id) {

        $ret = $this->mysqli->query(
            "SELECT q.*, u.fio FROM
                    Quests AS q JOIN Users AS u ON q.user_id = u.id
                WHERE q.id = $id;");

        if (!$ret) {
            return null;
        }

        $quest = $ret->fetch_assoc();
        if (empty($quest)) {
            return null;
        }

        $quest = (object)$quest;
        $obj = json_decode(base64_decode($quest->data));
        $obj->id = $quest->id;
        $obj->uid = $quest->user_id;

        return $obj;
    }
}
