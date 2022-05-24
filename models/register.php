<?php

class Register extends Dbh {
    protected function setUser($fname, $lname, $email, $contactNum, $companyName, $username, $password){
        $access = "regular";//default access for client

        $stmt = $this->connect()->prepare('INSERT INTO user(first_name, last_name, email, contact, company_name, username, password, access) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?);');

        //check if success
        if(!$stmt->execute(array($fname, $lname, $email, $contactNum, $companyName, $username, $password, $access))){
            $stmt = null;
            header("location: ../register.php?error=stmtFailed");
            exit();
        }

        $stmt = null;
    }

    protected function checkUser($username){
        $stmt = $this->connect()->prepare('SELECT * FROM user WHERE username = ?;');

        //check if success
        if(!$stmt->execute(array($username))){
            $stmt = null;
            header("location: ../register.php?error=stmtFailed");
            exit();
        }

        $resultCheck;
        if($stmt->rowCount() > 0){
            $resultCheck = false;
        }else {
            $resultCheck = true;
        }

        return $resultCheck;
    }
}