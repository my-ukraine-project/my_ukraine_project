<?php

class Model_Quests extends Model {

    public function add_quest($user, $object) {
        $quest = json_encode($object);
        $ret = $this->mysqli->query("INSERT INTO Quests (data, user_id) VALUE ('$quest', $user->id)");
        return $ret && ($this->mysqli->affected_rows == 1);
    }

    public function get_quests() {
        $ret = $this->mysqli->query(
        "SELECT q.*, u.fio FROM
                    Quests AS q JOIN Users AS u ON q.user_id = u.id
                LIMIT 100;");
        return $ret ? $ret->fetch_all( MYSQLI_ASSOC ) : null;
    }


    public function get_quest_by_id($id) {
        $ret = $this->mysqli->query(
            "SELECT q.*, u.fio FROM
                    Quests AS q JOIN Users AS u ON q.user_id = u.id
                WHERE q.id = $id;");
        return $ret ? (object)$ret->fetch_assoc() : null;
    }

}
