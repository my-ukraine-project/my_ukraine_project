<?php

class Model_SignUp extends Model {

    public function mail_exists($email) {
        $ret = $this->mysqli->query("SELECT * FROM sagaidacniy.users WHERE email = '{$email}' LIMIT 1");
        return $ret->num_rows == 1;
    }

    public function register($email, $password) {
        $p = sha1($password);
        $ret = $this->mysqli->query("INSERT INTO sagaidacniy.users (email, password) VALUES ('$email', '$p')");
        return $ret && ($this->mysqli->affected_rows == 1);
    }
}
