<?php

class RegisterController extends Register {
    private $fname;
    private $lname;
    private $email;
    private $contactNum;
    private $companyName;
    private $username;
    private $password;
    private $conPassword;
    
    public function __construct($fname, $lname, $email, $contactNum, $companyName, $username, $password, $conPassword){
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->contactNum = $contactNum;
        $this->companyName = $companyName;
        $this->username = $username;
        $this->password = $password;
        $this->conPassword = $conPassword;
    }

    public function registerUser() {
        if($this->emptyInput() == false){
            //redirect to
            header("location: ../register.php?error=incomplete&fname=$this->fname&lname=$this->lname&email=$this->email&contactNum=$this->contactNum&companyName=$this->companyName&username=$this->username");
            exit();
        }

        if($this->checkUserTaken() == false){
            //redirect to
            header("location: ../register.php?error=username&fname=$this->fname&lname=$this->lname&email=$this->email&contactNum=$this->contactNum&companyName=$this->companyName&username=$this->username");
            exit();
        }

        if($this->passwordMatch() == false){
            //redirect to
            header("location: ../register.php?error=conPassword&fname=$this->fname&lname=$this->lname&email=$this->email&contactNum=$this->contactNum&companyName=$this->companyName&username=$this->username");
            exit();
        }

        $this->setUser($this->fname, $this->lname, $this->email, $this->contactNum, $this->companyName, $this->username, $this->password);
    }

    private function emptyInput() {
        $result;

        if(empty($this->fname) || empty($this->lname) || empty($this->email) || empty($this->contactNum) || empty($this->companyName) || empty($this->username) || empty($this->password) || empty($this->conPassword)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

    private function checkUserTaken() {
        $result;

        if(!$this->checkUser($this->username)){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

    private function passwordMatch() {
        $result;

        if($this->password != $this->conPassword){
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }
}