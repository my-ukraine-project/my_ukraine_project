<?php

class Model {

    function __construct() {
        $this->mysqli = new mysqli(DATABASE_HOST, DATABASE_LOGIN, DATABASE_PASSWORD, DATABASE_NAME);
        if ($this->mysqli->connect_errno) {
            throw new Exception("Exception: Database error: " . $this->mysqli->connect_error, 701);
        }

        if (!$this->mysqli->set_charset("utf8")) {
            throw new Exception("Exception: Database can`t set encoding" . $this->mysqli->error, 702);
        }
    }

    public function escape($string) {
        return $this->mysqli->real_escape_string(trim(htmlspecialchars(trim($string))));
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

    public function check_permission() {
        $data = $this->get_user_by_session();
        return $data ? !!$data->permission : false;
    }

}
