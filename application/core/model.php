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


    public function mail_exists($email) {
        $ret = $this->mysqli->query("SELECT * FROM Users WHERE email = '{$email}' LIMIT 1");
        return $ret->num_rows == 1;
    }

    public function get_rating() {
        $ret = $this->mysqli->query(
            "SELECT u.fio as fio, SUM(c.mark) as summark, COUNT(*) AS quests FROM
                    Completed_Quests AS c JOIN Users AS u ON c.user_id = u.id GROUP BY fio ORDER BY summark DESC;");

        return $ret ? $ret->fetch_all( MYSQLI_ASSOC ) : null;
    }

    public function get_user_by_session() {
        if (empty($_COOKIE['uid'])) {
            return null;
        }

//        if (!empty($_SESSION['user'])) {
//            $usr = $_SESSION['user'];
//            return (object)array("fio" => $usr->first_name ." ". $usr->last_name);
//        }

        $cookie = $this->escape($_COOKIE['uid']);

        $ret = $this->mysqli->query(
            "SELECT u.* FROM
                      Users AS u JOIN User_Session AS s ON u.id = s.user_id 
                    WHERE s.cookie = '$cookie' LIMIT 1"
        );

        return ($ret && ($ret->num_rows == 1)) ? $ret->fetch_object() : null;
    }

    public function remove_user_session() {
        if (empty($_COOKIE['uid'])) {
            return null;
        }

        $cookie = $this->escape($_COOKIE['uid']);
        $this->mysqli->query("DELETE FROM User_Session WHERE cookie = '$cookie';");
    }

    public function get_progress($uid) {
        $r1 = $this->mysqli->query("SELECT count(*) AS count FROM Quests");
        $r2 = $this->mysqli->query("SELECT count(*) AS count FROM Completed_Quests WHERE user_id = $uid");
        $c1 = $r1->fetch_object();
        $c2 = $r2->fetch_object();

        if (empty($c1) || empty($c2)) {
            return 0;
        }

        return ($c2->count / $c1->count) * 100;
    }

    public function check_permission() {
        $data = $this->get_user_by_session();
        return $data ? !!$data->permission : false;
    }

}
