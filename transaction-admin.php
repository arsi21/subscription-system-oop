<?php
include_once("includes/check-access.php");
include "lib/dbh.php";
include "models/transactions.php";

//check access
if(!checkIfAdmin()){
    header("location:index.php");
}

//Instantiate Class
$transactions = new Transactions();

//get data from database
$transactionData = $transactions->getTransaction();
$transactionCount = $transactions->getTransactionCount();
?>

<?php include_once("partials/header.php");?>

<div class="container">
    <p class="mt-3 text-muted">Transaction History</p>

    <div class="mb-5 overflow-auto">
        <table class="table caption-top table-hover">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Product Name</th>
                <th scope="col">Amount</th>
                <th scope="col">Paid date</th>
                <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
            <?php //output data
                foreach($transactionData as $row){ ?>
                <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['subscription_name']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['paid_date']; ?></td>
                <td><?php echo $row['status']; ?></td>
                </tr>
            <?php }?>
            
            </tbody>
        </table>
        <?php
            if($transactionCount <= 0){
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