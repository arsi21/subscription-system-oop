<?php
include_once("includes/check-access.php");

//check access
if(!checkIfRegular()){
  header("location:index.php");
}

//check if successful
if(!empty($_GET['tid']) && !empty($_GET['product']) && !empty($_GET['amount'])) {
    $GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);

    $tid = $GET['tid'];
    $product = $GET['product'];
    $amount = $GET['amount'];
} else {
    header('Location: unpaid.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Payment Page</title>
</head>
<body>
  <div class="container mt-5">

    <div class="card" style="max-width: 30rem; margin-inline: auto;">
      <div class="card-header">Payment Successful</div>
      <div class="card-body">
        <h5 class="card-title"><?php echo $product; ?></h5>
        <h6 class="card-subtitle mb-2 text-muted">Transaction ID: <?php echo $tid; ?></h6>
        <p class="card-text">Amount: <strong>PHP <?php echo $amount; ?>.00</strong></p>
        <p class="card-text">Check your email for receipt.</p>
        <a href="payment.php" class="btn btn-primary">Go Back</a>
      </div>
    </div>

  </div>
</body>
</html>