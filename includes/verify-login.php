<?php

if(isset($_POST['loginBtn'])){
    //get data
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Instantiate Class
    include "../lib/dbh.php";
    include "../models/login.php";
    include "../controllers/login-controller.php";
    $login = new LoginController($username, $password);

    //Error handler and login
    $login->loginUser();

    //start session
    if(!isset($_SESSION)){
        session_start();
    }

    //check if admin
    if($_SESSION['access'] == "admin"){
        header("location: ../dashboard.php");
    }elseif($_SESSION['access'] == "regular"){
        if(!empty($_GET['invoice_id'])){
            header("location:../payment.php?invoice_id=$_GET[invoice_id]");
        }else{
            header("location: ../subscription.php");
        }
    }
   
}