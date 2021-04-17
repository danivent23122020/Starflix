<?php


class Users extends DbConn {

    public function getUsers() {
        $sql = "SELECT id, pseudo FROM users";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}



?>