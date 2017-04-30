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
}
