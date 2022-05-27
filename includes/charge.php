<?php
require_once('../stripe-php/init.php');
require_once "../lib/dbh.php";
require_once "../models/invoices.php";
require_once "../models/transactions.php";
require_once "../controllers/invoices-controller.php";
require_once "../views/invoices-view.php";
require_once "../controllers/transactions-controller.php";

//secret key
\Stripe\Stripe::setApiKey('sk_test_51L258cIdb8QumP2NX3ZHZrUxYyg9sIPtU7axYIVWk0aksO9SRbFYZQW3Uix893i3yhhjYRYY6HjuhFnyQc9QoIqb00IIevx6Bv');

// Sanitize POST Array
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

//get submitted data from charge
$invoice_id = $POST['invoice_id'];
$user_id = $POST['user_id'];
$token = $POST['stripeToken'];
$subscription_name = $POST['subscription_name'];
$amount = $POST['amount'];

//Instantiate Class
$invoicesView = new InvoicesView();
$invoicesController = new InvoicesController($invoice_id);

//get user data
$row = $invoicesView->showInvoiceUserInfo($invoice_id);

//fetched data
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$fullname = $first_name . " " . $last_name;
$email = $row['email'];

// Create Customer In Stripe
$customer = \Stripe\Customer::create(array(
  "name" => $fullname,
  "email" => $email,
  "source" => $token
));

// Charge Customer
$charge = \Stripe\Charge::create(array(
  "amount" => $amount . "00",
  "currency" => "php",
  "description" => $subscription_name,
  "customer" => $customer->id
));

//Instantiate Class
$invoices = new Invoices();
$transactionsController = new TransactionsController($charge->id, $user_id, $invoice_id, $amount, $charge->status);

//insert transaction data
$transactionsController->addTransaction();

//check if succeeded
if($charge->status == "succeeded"){
  //update invoice
  $invoicesController->updateInvoiceStatus($invoice_id);
}

include_once('send-receipt-email.php');

// Redirect to success
header('Location: ../success.php?tid='.$charge->id.'&product='.$charge->description.'&amount='.$amount);