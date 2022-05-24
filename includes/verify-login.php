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

    //Redirect to page
    header("location: ../dashboard.php");
}