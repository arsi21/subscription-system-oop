<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Subscription System</title>
</head>
<body>
    <div class="container-sm d-flex justify-content-center align-items-center mt-5">
        <div class="card px-3 py-3" style="width: 30rem;">
        <div class="card-body">
            <?php 
                //for redirecting to payment when click the link in email
                $invoice_id = "";
                if(isset($_GET['invoice_id'])){
                    $invoice_id = $_GET['invoice_id'];
                };
            ?>
            <form method="post" action="includes/verify-login.php?invoice_id=<?php echo $invoice_id?>">
                <h1>Login</h1>

                    <?php 
                        //for showing error
                        if(isset($_GET['error'])){
                            $error = $_GET['error'];

                            if($error == "didNotMatch"){
                                echo('
                                    <div class="alert alert-warning mt-3" role="alert">
                                        Username and password did not match!
                                    </div>
                                ');
                            }elseif($error == "emptyInput"){
                                echo('
                                    <div class="alert alert-warning mt-3" role="alert">
                                        Fill up all fields!
                                    </div>
                                ');
                            }
                        }
                    ?>

                <?php
                    //for showing the inputed value
                    if(isset($_GET['username'])){
                        //get data from the verify-login
                        $username = $_GET['username'];
                ?>
                        <div class="mb-3 mt-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $username;?>" required>
                        </div>

                        <div class="mb-3 mt-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                <?php
                    }else{
                ?>
                        <!-- for showing input fields -->
                        <div class="mb-3 mt-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>

                        <div class="mb-3 mt-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                <?php
                    }
                ?>

                <button type="submit" name="loginBtn" class="btn btn-primary mt-4">Login</button>
            </form>
        </div>
        </div>
    </div>

</body>
</html>