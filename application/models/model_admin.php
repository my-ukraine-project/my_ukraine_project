<?php

class Model_Admin extends Model {

    public function get_users() {
        $ret = $this->mysqli->query("SELECT * FROM Users");
        return $ret ? $ret->fetch_all( MYSQLI_ASSOC ) : null;
    }

    public function update_user_permission($id, $permission) {
        $ret = $this->mysqli->query("UPDATE Users SET permission = $permission WHERE id = $id");
        return !!$ret;
    }
}
