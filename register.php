<?php
// include_once("server/check-access.php");

//start session
if(!isset($_SESSION)){
    session_start();
}

//check if admin
if($_SESSION['access'] != "admin"){
    header("location:index.php");
}
?>


<?php include_once("partials/header.php"); ?>

<div class="container-sm d-flex justify-content-center align-items-center mt-5 mb-5">
    <div class="card px-3 py-3" style="width: 30rem;">
    <div class="card-body">
        <form method="post" action="includes/add-client.php">
            <h2>Register Client</h2>

            <?php 
                //for showing error
                if(isset($_GET['error'])){
                    $error = $_GET['error'];

                    if($error == "username"){
                        echo '
                            <div class="alert alert-warning" role="alert">
                                Username already exist!
                            </div>
                        ';
                    }elseif($error == "conPassword"){
                        echo '
                            <div class="alert alert-warning" role="alert">
                                Password and confirm password did not match!
                            </div>
                        ';
                    }elseif($error == "incomplete"){
                        echo '
                            <div class="alert alert-warning" role="alert">
                                Fill up all fields!
                            </div>
                        ';
                    }
                }
            ?>


            <?php
                //for showing the inputed value
                if(isset($_GET['fname']) || isset($_GET['lname']) || isset($_GET['email']) || isset($_GET['contactNum']) || isset($_GET['companyName']) || isset($_GET['username'])){
                    //get data from the add-client
                    if(isset($_GET['fname'])){
                        $fname = $_GET['fname'];
                    }else{
                        $fname = "";
                    }

                    if(isset($_GET['lname'])){
                        $lname = $_GET['lname'];
                    }else{
                        $lname = "";
                    }

                    if(isset($_GET['email'])){
                        $email = $_GET['email'];
                    }else{
                        $email = "";
                    }

                    if(isset($_GET['contactNum'])){
                        $contactNum = $_GET['contactNum'];
                    }else{
                        $contactNum = "";
                    }

                    if(isset($_GET['companyName'])){
                        $companyName = $_GET['companyName'];
                    }else{
                        $companyName = "";
                    }

                    if(isset($_GET['username'])){
                        $username = $_GET['username'];
                    }else{
                        $username = "";
                    }
            ?>

            <div class="mb-3 mt-3">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" name="fname" value="<?php echo $fname;?>" required>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lname" value="<?php echo $lname;?>" required>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $email;?>" required>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Contact Number</label>
                <input type="number" class="form-control" name="contactNum" value="<?php echo $contactNum;?>" required>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Company Name</label>
                <input type="text" class="form-control" name="companyName" value="<?php echo $companyName;?>" required>
            </div>
            

            <div class="mb-3 mt-5">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" value="<?php echo $username;?>" required>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="conPassword" required>
            </div>




            <?php
                }else{
            ?>




            <div class="mb-3 mt-3">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" name="fname" required>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lname" required>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Contact Number</label>
                <input type="number" class="form-control" name="contactNum" required>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Company Name</label>
                <input type="text" class="form-control" name="companyName" required>
            </div>
            

            <div class="mb-3 mt-5">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="mb-3 mt-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="conPassword" required>
            </div>

            <?php
                }
            ?>  

            <button type="submit" name="registerBtn" class="btn btn-primary mt-4">Register</button>
        </form>
    </div>
    </div>
</div>

<!-- <script src="js/send-email.js"></script> -->
<?php include_once("partials/footer.php") ?>