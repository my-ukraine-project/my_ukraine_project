<?php

class Model_SignUp extends Model {

    public function mail_exists($email) {
        $ret = $this->mysqli->query("SELECT * FROM Users WHERE email = '{$email}' LIMIT 1");
        return $ret->num_rows == 1;
    }

    public function register($fio, $email, $password) {
        $p = sha1($password);
        $ret = $this->mysqli->query(
            "INSERT INTO Users (fio, email, password) VALUES ('$fio','$email', '$p')"
        );
        return $ret && ($this->mysqli->affected_rows == 1);
    }
}
