<?php
include_once("includes/check-access.php");
include "lib/dbh.php";
include "models/invoices.php";

//check access
if(!checkIfRegular()){
  header("location:index.php");
}

//Instantiate Class
$invoices = new Invoices();

//check if there is invoice value
if(!empty($_GET['invoice_id'])){
  $invoice_id = $_GET['invoice_id'];//get invoice id

  //get data from database
  $unpaidInvoiceCount = $invoices->getUnpaidInvoiceCount($invoice_id);

  //check if it is already paid
  if($unpaidInvoiceCount <= 0){
      //if paid already redirect to transaction page
      header('Location: transaction.php');
  }

}else{
  header('Location: unpaid.php');
}

$row = $invoices->getInvoiceInfo($invoice_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Payment Page</title>
</head>
<body>
  <div class="container">
    <div class="card mt-5"  style="max-width: 30rem; min-width: 30rem; margin-inline: auto;">
      <div class="card-header">
        Payment
      </div>
      <div class="card-body">
        <h5 class="card-title"><?php echo $row['subscription_name']; ?></h5>
        <p class="card-text">Amount: Php <?php echo $row['amount']; ?></p>
        <p class="card-text">Due date: <?php echo $row['pay_by']; ?></p>

        <form action="includes/charge.php" method="post" id="payment-form">
          <div class="form-row">
              <!-- for transferring data to charge -->
              <input type="hidden" name="invoice_id" value="<?php echo $row['id']; ?>">
              <input type="hidden" name="subscription_name" value="<?php echo $row['subscription_name']; ?>">
              <input type="hidden" name="amount" value="<?php echo $row['amount']; ?>">
              <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
            
              <div id="card-element" class="form-control">
                <!-- a Stripe Element will be inserted here. -->
              </div>

              <!-- Used to display form errors -->
              <div id="card-errors" role="alert"></div>
          </div>

          <button class="btn btn-primary">Submit Payment</button>
        </form>
      </div>
    </div>

  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="./js/charge.js"></script>
</body>
</html>