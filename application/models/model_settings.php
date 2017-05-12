<?php

class Model_Settings extends Model {

    function save_settings($user, $fio, $email, $password, $phone, $city, $school) {

        $p = sha1($password);



        $this->mysqli->autocommit(false);

        $ret = $this->mysqli->query("
            UPDATE Users SET
              fio = '$fio',
              email = '$email',
              password = '$p'
            WHERE id = $user->id"
        );

        if (!$ret) {
            echo mysqli_error($this->mysqli);
            return null;
        }

        $ret = $this->mysqli->query("
            INSERT INTO User_Info (phone, city, school, user_id)  VALUE (
              '$phone', '$city', '$school', $user->id)
            ON DUPLICATE KEY UPDATE phone = '$phone', city = '$city', school = '$school';
        ");

        if (!$ret) {
            echo mysqli_error($this->mysqli);
            return null;
        }

        $this->mysqli->commit();

        return $ret;
    }

    function get_user_full($user) {

        $ret = $this->mysqli->query(
            "SELECT * FROM  User_Info AS i WHERE i.user_id = $user->id LIMIT 1"
        );

        $x = array(
            "id" => $user->id,
            "fio" => $user->fio,
            "email" => $user->email,
            "password" => $user->password,
            "school" => "",  "phone" => "",  "city" => ""
        );

        if ($ret && ($ret->num_rows == 1)) {
            $uif = $ret->fetch_object();
            $x["school"] = $uif->school;
            $x["phone"] = $uif->phone;
            $x["city"] = $uif->city;
        }

        return (object)$x;
    }

}

