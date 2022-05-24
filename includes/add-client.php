<?php
//check if the register button is clicked
if(isset($_POST['registerBtn'])){
    //get data from the form
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $contactNum = $_POST['contactNum'];
    $companyName = $_POST['companyName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $conPassword = $_POST['conPassword'];

    //instantiate class
    include "../lib/dbh.php";
    include "../models/register.php";
    include "../controllers/register-controller.php";
    $register = new RegisterController($fname, $lname, $email, $contactNum, $companyName, $username, $password, $conPassword);

    //Error handler and login
    $register->registerUser();

    //Redirect to page
    header("location: ../register.php");
}