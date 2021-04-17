<?php


class Comments extends DbConn {

    function setComments() {
        if (isset($_POST['commentSubmit'])) {
            if (!empty($_POST['message'])) {

                $id_user = $_POST['idUser'];
                $id_movie = $_POST['idMovie'];
                $date = $_POST['date'];
                $message = htmlspecialchars(trim($_POST['message']));
               
                
                $sql = "INSERT INTO comments (idUser, idMovie, date, message) VALUES ('$id_user', '$id_movie', '$date', '$message')";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute();
            } 

        }
        
    }


    function getComments() {
        $sql = "SELECT id, idUser, idMovie, date, message FROM comments";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        

        return $stmt->fetchAll();
    }



}







?>