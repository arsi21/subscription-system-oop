<?php
//Instantiate Class
include "lib/dbh.php";
include "models/transactions.php";
include "views/transactions-view.php";
$transactions = new TransactionsView();

//get data from database
$transactionsInfo = $transactions->showTransaction();
$transactionsTotal = $transactions->showTransactionTotal();