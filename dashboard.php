<?php
include_once("includes/show-analytics.php");
// include_once("server/check-access.php");

//start session
if(!isset($_SESSION)){
    session_start();
}

if($_SESSION['access'] != "admin"){
    header("location:index.php");
}
?>



<?php include_once("partials/header.php"); ?>




<div class="container mt-3">
    <h2>Dashboard</h2>


    <div class="d-flex flex-wrap gap-3 mt-4 justify-content-center">
        <div class="card border-primary mb-3" style="min-width: 18rem;">
            <div class="card-header">Total User</div>
            <div class="card-body text-primary">
                <h5 class="card-title"><?php echo $totalUsers; ?></h5>
            </div>
        </div>

        <div class="card border-success mb-3" style="min-width: 18rem;">
            <div class="card-header">Total Paid Subscription</div>
            <div class="card-body text-success">
                <h5 class="card-title"><?php echo $totalPaid; ?></h5>
            </div>
        </div>

        <div class="card border-danger mb-3" style="min-width: 18rem;">
            <div class="card-header">Total Unpaid Subscription</div>
            <div class="card-body text-danger">
                <h5 class="card-title"><?php echo $totalUnpaid; ?></h5>
            </div>
        </div>
    </div>

    <p class="mt-3 text-muted">Subscription Info</p>

    <div class="mt-3 mb-5 overflow-auto">
        <table class="table caption-top table-hover">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Product Name</th>
                <th scope="col">User-Id</th>
                <th scope="col">User-Name</th>
                <th scope="col">Amount</th>
                <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php //output data
                foreach($subscriptionInfo as $row){ ?>
                <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['subscription_name']; ?></td>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['status']; ?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <?php
            if($subscriptionInfoTotal <= 0){
                echo
                    '<p class="lead text-center">
                        No data found!
                    </p>';
            }
        ?>
    </div>
</div>


<!-- <script src="js/send-email.js"></script> -->
<?php include_once("partials/footer.php") ?>