<?php

class Login extends Dbh {
    protected function getUser($username, $password){
        $stmt = $this->connect()->prepare('SELECT * FROM user WHERE username = ? AND password = ?;');

        //check if success
        if(!$stmt->execute(array($username, $password))){
            $stmt = null;
            header("location: ../index.php?error=stmtFailed");
            exit();
        }

        //check if password and username match
        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../index.php?error=didNotMatch");
            exit();
        }

        $user = $stmt->fetchAll();

        session_start();

        //set session
        $_SESSION['id'] = $user[0]['id'];
        $_SESSION['username'] = $user[0]['username'];
        $_SESSION['access'] = $user[0]['access'];

        $stmt = null;
    }
}