<?php
// include_once("server/check-access.php");
include "lib/dbh.php";
include "models/subscriptions.php";

//Instantiate Class
$subscriptions = new Subscriptions();

//start session
if(!isset($_SESSION)){
    session_start();
}

$id = $_SESSION['id'];

//get data from database
$subscriptionsData = $subscriptions->getSubscriptions($id);
$subscriptionsCount = $subscriptions->getSubscriptionsCount($id);
?>

<?php include_once("partials/header.php");?>

<div class="container mt-3">
<h2>Subscriptions</h2>
</div>

<div class="container d-flex flex-wrap gap-5 mt-5">
    <?php //output data
        foreach($subscriptionsData as $row){ ?>
    <div class="card" style="min-width: 18rem;">
        <div class="card-header">
        <?php echo $row['subscription_name']; ?>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Plan: </strong><?php echo $row['plan']; ?> month/s</li>
            <li class="list-group-item"><strong>Amount: </strong><?php echo $row['amount']; ?> php</li>
            <li class="list-group-item"><strong>Start: </strong><?php echo $row['start']; ?></li>
            <li class="list-group-item"><strong>End: </strong><?php echo $row['end']; ?></li>
        </ul>
    </div>
    <?php }?>
</div>

<?php include_once("partials/footer.php") ?>