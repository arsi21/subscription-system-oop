<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="js/jquery.js"></script>

    <title>Subscription System</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Subscription</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse md-flex justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <?php
            //start session
            if(!isset($_SESSION)){
                session_start();
            }

            //check if the user is admin
            if(isset($_SESSION['access'])){
                if($_SESSION['access'] == "regular"){
            ?>

            <li class="nav-item">
            <a class="nav-link" href="subscription.php">Subscription</a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="unpaid.php">Unpaid</a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="transaction.php">Transaction</a>
            </li>

            <?php
                }elseif($_SESSION['access'] == "admin"){
            ?>
                <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>

                <li class="nav-item">
                <a class="nav-link" href="transaction-admin.php">Transaction</a>
                </li>

                <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
                </li>
            <?php    
                }
            }
            ?>
            
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php 
                    echo $_SESSION['username'];
                ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="includes/logout.php">Logout</a></li>
            </ul>
            </li>
        </ul>
        </div>
    </div>
    </nav>