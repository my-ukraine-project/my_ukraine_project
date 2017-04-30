<?php

class Model_Main extends Model {

    public function user_exists($email, $password) {
        $p = sha1($password);
        $ret = $this->mysqli->query(
            "SELECT * FROM sagaidacniy.users WHERE email = '{$email}' AND password = '{$p}' LIMIT 1"
        );
        return $ret && ($ret->num_rows == 1);
    }
}
