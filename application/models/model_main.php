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


}
