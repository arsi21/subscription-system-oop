<?php

class Dbh {
    protected function connect(){
        try {
            $host = "localhost";
            $user = "root";
            $pwd = "";
            $dbName = "subscription_db";

            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
            $dbh = new PDO($dsn, $this->user, $this->pwd);
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $dbh;
        } catch (PDOException $e){
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}