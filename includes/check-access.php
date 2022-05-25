<?php 
 //start session
if(!isset($_SESSION)){
    session_start();
}

//check if session username and password has value
if(!isset($_SESSION['username']) || !isset($_SESSION['id']) || !isset($_SESSION['access'])){
    header("location:index.php");
}

function checkIfAdmin(){
    $result;

    if($_SESSION['access'] == "admin"){
        $result = true;
    }else{
        $result = false;
    }

    return $result;
}

function checkIfRegular(){
    $result;

    if($_SESSION['access'] == "regular"){
        $result = true;
    }else{
        $result = false;
    }

    return $result;
}
?>