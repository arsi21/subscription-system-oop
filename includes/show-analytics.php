<?php
//Instantiate Class
include "lib/dbh.php";
include "models/analytics.php";
include "views/analytics-view.php";
$analytics = new AnalyticsView();

//get data from database
$totalUsers = $analytics->showTotalUsers();
$totalPaid = $analytics->showTotalPaid();
$totalUnpaid = $analytics->showTotalUnpaid();
$subscriptionInfo = $analytics->showSubscriptionInfo();
$subscriptionInfoTotal = $analytics->showSubscriptionInfoTotal();