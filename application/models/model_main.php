<?php

class Model_Main extends Model {

    public function get_user($email, $password) {
        $p = sha1($password);
        $ret = $this->mysqli->query(
            "SELECT * FROM Users WHERE email = '{$email}' AND password = '{$p}' LIMIT 1"
        );
        return ($ret && ($ret->num_rows == 1)) ? $ret->fetch_object() : null;
    }

    public function save_session($uid, $cookie, $ttl) {
        echo json_encode(array($uid, $cookie, $ttl));
        $ret = $this->mysqli->query(
            "INSERT INTO User_Session (user_id, cookie, ttl) VALUE ($uid,'$cookie', '$ttl')"
        );
    }

    public function get_user_by_session() {
        if (empty($_COOKIE['uid'])) {
            return null;
        }

        $cookie = $this->escape($_COOKIE['uid']);

        $ret = $this->mysqli->query(
            "SELECT u.* FROM
                      Users AS u JOIN User_Session AS s ON u.id = s.user_id 
                    WHERE s.cookie = '$cookie' LIMIT 1"
        );

        return ($ret && ($ret->num_rows == 1)) ? $ret->fetch_object() : null;
    }

}
